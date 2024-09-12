<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categories = ['dunkel', 'weiss'];
        const totalElements = {
            dunkel: document.getElementById('total-dunkel'),
            weiss: document.getElementById('total-weiss')
        };

        function calculateTotals(category) {
            let total = 0;

            document.querySelectorAll(`#tab-${category} .card`).forEach(function(card) {
                let articleTotal = 0;
                card.querySelectorAll('.quantity-input').forEach(function(input) {
                    const quantity = parseInt(input.value) || 0;
                    const price = parseFloat(input.getAttribute('data-price'));
                    let articleSubtotal = quantity * price;

                    const commentInputName = `comment_${input.getAttribute('name')}_${category}`;
                    const commentElement = document.querySelector(`[name='${commentInputName}']`);
                    const comment = commentElement ? commentElement.value.trim() : '';

                    if (commentElement && comment) {
                        articleSubtotal += 6 * quantity; // Add 6€ per item for labels
                    }

                    articleTotal += articleSubtotal;
                });
                card.querySelector('.article-total').innerText = articleTotal.toFixed(2).replace('.', ',') + ' €';
                total += articleTotal;
            });

            totalElements[category].innerText = total.toFixed(2).replace('.', ',');
        }

        function setupEventListeners(category) {
            // Event Listener für Mengenänderung und Kommentaränderung
            document.querySelectorAll(`#tab-${category} .quantity-input`).forEach(input => {
                input.addEventListener('input', function() {
                    calculateTotals(category);
                });
            });

            document.querySelectorAll(`#tab-${category} textarea`).forEach(textarea => {
                textarea.addEventListener('blur', function() {
                    calculateTotals(category);
                });
            });

            // Event Listener für Auf- und Zuklappen
            document.querySelectorAll(`#tab-${category} .toggle-sizes`).forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('data-target');
                    const sizesContainer = document.getElementById(targetId);

                    if (sizesContainer.style.display === 'none' || sizesContainer.style.display === '') {
                        sizesContainer.style.display = 'block';
                        this.innerHTML = 'Größen &#9650;';
                    } else {
                        sizesContainer.style.display = 'none';
                        this.innerHTML = 'Größen &#9660;';
                    }
                });
            });
        }

        function initialize() {
            categories.forEach(category => {
                setupEventListeners(category);
                calculateTotals(category); // Initiale Berechnung
            });

            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(item => item.classList.remove('active'));
                    document.querySelectorAll('.tab-content-shop').forEach(content => content.classList.remove('active'));

                    this.classList.add('active');
                    document.getElementById(this.getAttribute('data-tab')).classList.add('active');
                });
            });

            // Setze den Standard-Tab
            tabs[0].classList.add('active');
            document.getElementById(`tab-${categories[0]}`).classList.add('active');

            const resetButton = document.getElementById('reset-amounts');
            if (resetButton) {
                resetButton.addEventListener('click', function() {
                    document.querySelectorAll('.quantity-input').forEach(function(input) {
                        input.value = 0;
                    });
                    categories.forEach(category => calculateTotals(category)); // Nach dem Zurücksetzen neu berechnen
                });
            }
        }

        initialize();
    });

    document.getElementById('save-order').addEventListener('click', function() {
        const orderDetails = [];

        // Dunkel articles
        document.querySelectorAll('#tab-dunkel .card').forEach(function(card) {
            card.querySelectorAll('.quantity-input').forEach(function(input) {
                const quantity = parseInt(input.value) || 0;
                if (quantity > 0) {
                    const inputName = input.getAttribute('name');
                    const commentInputName = `comment_${inputName}_dunkel`;
                    const commentElement = document.querySelector(`[name='${commentInputName}']`);
                    const comment = commentElement ? commentElement.value.trim() : '';

                    const canBeLabeled = card.querySelector('textarea') ? true : false;

                    orderDetails.push({
                        article_name: card.querySelector('.card-title').textContent.trim(),
                        variant_name: input.getAttribute('name').split('_')[1],
                        size: input.getAttribute('placeholder'),
                        quantity: quantity,
                        price: parseFloat(input.getAttribute('data-price')),
                        total: quantity * parseFloat(input.getAttribute('data-price')),
                        color: 'dunkel',
                        comment: comment,
                        can_be_labeled: canBeLabeled
                    });
                }
            });
        });

        // Weiß articles
        document.querySelectorAll('#tab-weiss .card').forEach(function(card) {
            card.querySelectorAll('.quantity-input').forEach(function(input) {
                const quantity = parseInt(input.value) || 0;
                if (quantity > 0) {
                    const inputName = input.getAttribute('name');
                    const commentInputName = `comment_${inputName}_weiss`;
                    const commentElement = document.querySelector(`[name='${commentInputName}']`);
                    const comment = commentElement ? commentElement.value.trim() : '';

                    const canBeLabeled = card.querySelector('textarea') ? true : false;

                    orderDetails.push({
                        article_name: card.querySelector('.card-title').textContent.trim(),
                        variant_name: input.getAttribute('name').split('_')[1],
                        size: input.getAttribute('placeholder'),
                        quantity: quantity,
                        price: parseFloat(input.getAttribute('data-price')),
                        total: quantity * parseFloat(input.getAttribute('data-price')),
                        color: 'weiss',
                        comment: comment,
                        can_be_labeled: canBeLabeled
                    });
                }
            });
        });

        // Send data to server
        fetch('save-order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    total_dunkel: document.getElementById('total-dunkel').textContent.replace(',', '.'),
                    total_weiss: document.getElementById('total-weiss').textContent.replace(',', '.'),
                    order_details: orderDetails
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Speichern',
                        text: 'Deine Daten wurden erfolgreich gespeichert!'
                    }).then(() => {
                        location.reload(); // Seite neu laden nach Erfolgsmeldung
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fehler',
                        text: 'Fehler beim Speichern der Bestellung: ' + data.message
                    });
                }
            });
    });


    document.getElementById('close-order').addEventListener('click', function() {
        // Send a request to mark the order as finished
        fetch('close-order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    user_id: <?= json_encode($user['id']) ?>
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const totalSum = parseFloat(document.getElementById('total-dunkel').textContent.replace(',', '.')) + parseFloat(document.getElementById('total-weiss').textContent.replace(',', '.'));

                    Swal.fire({
                        icon: 'success',
                        title: 'Bestellung abgeschlossen',
                        text: `Die Bestellung ist abgeschlossen. Bitte überweise die Summe von ${totalSum.toFixed(2).replace('.', ',')} € auf das Paypal-Konto von Daniela Ulrich (@DanielaUlrich168).`
                    }).then(() => {
                        // Disable all form fields after the SweetAlert dialog is closed
                        document.querySelectorAll('input, textarea, button').forEach(field => {
                            field.disabled = true;
                        });

                        // Keep the close-order button disabled
                        document.getElementById('close-order').disabled = true;
                    }).then(() => {
                        location.reload(); // Seite neu laden nach Erfolgsmeldung
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fehler',
                        text: 'Fehler beim Abschließen der Bestellung: ' + data.message
                    });
                }
            });
    });

    document.getElementById('reset-amounts').addEventListener('click', function() {
        // Set all quantity inputs to 0 in Dunkel section
        document.querySelectorAll('#tab-dunkel .quantity-input').forEach(function(input) {
            input.value = 0;
        });

        // Set all quantity inputs to 0 in Weiß section
        document.querySelectorAll('#tab-weiss .quantity-input').forEach(function(input) {
            input.value = 0;
        });

        // Recalculate the totals after resetting
        categories.forEach(category => calculateTotals(category)); // Recalculate for both categories
    });
</script>