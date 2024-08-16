<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const totalSchwarzElement = document.getElementById('total-schwarz');
    const totalWeissElement = document.getElementById('total-weiss');

    function calculateTotals() {
        let totalSchwarz = 0;
        let totalWeiss = 0;

        document.querySelectorAll('#tab-schwarz .card').forEach(function(card) {
            let articleTotal = 0;
            card.querySelectorAll('.quantity-input').forEach(function(input) {
                const quantity = parseInt(input.value) || 0;
                const price = parseFloat(input.getAttribute('data-price'));
                articleTotal += quantity * price;
            });
            card.querySelector('.article-total').innerText = articleTotal.toFixed(2).replace('.', ',') + ' €';
            totalSchwarz += articleTotal;
        });

        document.querySelectorAll('#tab-weiss .card').forEach(function(card) {
            let articleTotal = 0;
            card.querySelectorAll('.quantity-input').forEach(function(input) {
                const quantity = parseInt(input.value) || 0;
                const price = parseFloat(input.getAttribute('data-price'));
                articleTotal += quantity * price;
            });
            card.querySelector('.article-total').innerText = articleTotal.toFixed(2).replace('.', ',') + ' €';
            totalWeiss += articleTotal;
        });

        totalSchwarzElement.innerText = totalSchwarz.toFixed(2).replace('.', ',');
        totalWeissElement.innerText = totalWeiss.toFixed(2).replace('.', ',');
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(item => item.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(this.getAttribute('data-tab')).classList.add('active');

            calculateTotals(); // Recalculate totals when switching tabs
        });
    });

    // Set the default active tab
    tabs[0].classList.add('active');
    document.getElementById('tab-schwarz').classList.add('active');

    // Add event listeners for quantity inputs to recalculate totals on change
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', calculateTotals);
    });

    // Reset all amounts to 0
    document.getElementById('reset-amounts').addEventListener('click', function() {
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.value = 0;
        });
        calculateTotals();
    });

    // Initial calculation
    calculateTotals();
});


document.getElementById('save-order').addEventListener('click', function() {
    const orderDetails = [];

    // Schwarz articles
    document.querySelectorAll('#tab-schwarz .card').forEach(function(card) {
        card.querySelectorAll('.quantity-input').forEach(function(input) {
            const quantity = parseInt(input.value) || 0;
            if (quantity > 0) {
                const inputName = input.getAttribute('name');
                const commentInputName = `comment_${inputName}_schwarz`;
                const comment = document.querySelector(`[name='${commentInputName}']`).value.trim();

                orderDetails.push({
                    article_name: card.querySelector('.card-title').textContent.trim(),
                    variant_name: input.getAttribute('name').split('_')[1],
                    size: input.getAttribute('placeholder'),
                    quantity: quantity,
                    price: parseFloat(input.getAttribute('data-price')),
                    total: quantity * parseFloat(input.getAttribute('data-price')),
                    color: 'schwarz',
                    comment: comment
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
                const comment = document.querySelector(`[name='${commentInputName}']`).value.trim();

                orderDetails.push({
                    article_name: card.querySelector('.card-title').textContent.trim(),
                    variant_name: input.getAttribute('name').split('_')[1],
                    size: input.getAttribute('placeholder'),
                    quantity: quantity,
                    price: parseFloat(input.getAttribute('data-price')),
                    total: quantity * parseFloat(input.getAttribute('data-price')),
                    color: 'weiss',
                    comment: comment
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
                total_schwarz: document.getElementById('total-schwarz').textContent.replace(',', '.'),
                total_weiss: document.getElementById('total-weiss').textContent.replace(',', '.'),
                order_details: orderDetails
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Erfolg',
                    text: 'Deine Daten wurden erfolgreich gespeichert!'
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
                const totalSum = parseFloat(document.getElementById('total-schwarz').textContent.replace(',', '.')) + parseFloat(document.getElementById('total-weiss').textContent.replace(',', '.'));

                Swal.fire({
                    icon: 'success',
                    title: 'Bestellung abgeschlossen',
                    text: `Die Bestellung ist abgeschlossen. Bitte überweise die Summe von ${totalSum.toFixed(2).replace('.', ',')} € auf das Paypal-Konto von Conny Roloff (https://www.paypal.com/paypalme/connyroloff).`
                }).then(() => {
                    // Disable all form fields after the SweetAlert dialog is closed
                    document.querySelectorAll('input, textarea, button').forEach(field => {
                        field.disabled = true;
                    });

                    // Keep the close-order button disabled
                    document.getElementById('close-order').disabled = true;
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
    // Set all quantity inputs to 0 in Schwarz section
    document.querySelectorAll('#tab-schwarz .quantity-input').forEach(function(input) {
        input.value = 0;
    });

    // Set all quantity inputs to 0 in Weiß section
    document.querySelectorAll('#tab-weiss .quantity-input').forEach(function(input) {
        input.value = 0;
    });

    // Recalculate the totals after resetting
    calculateTotals();
});


</script>
