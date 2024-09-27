function formatRupiah(angka) {
    const numberString = angka.toString().replace(/[^,\d]/g, "");
    const split = numberString.split(",");
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        const separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah =
        split[1] !== undefined ? rupiah + "," + split[1].substr(0, 2) : rupiah;
    return "Rp " + rupiah;
}

function unformatRupiah(rupiah) {
    return parseFloat(rupiah.replace(/[^0-9,-]+/g, ""));
}

function calculateInvoice() {
    let subtotal = 0;

    $("#tableBody tr").each(function () {
        const qty = parseFloat($(this).find('input[name$="[qty]"]').val()) || 0;

        const rateRupiah = $(this).find('input[name$="[harga_item]"]').val();
        const rate = unformatRupiah(rateRupiah) || 0;

        const amount = qty * rate;
        $(this).find('input[name$="[amount]"]').val(formatRupiah(amount));

        subtotal += amount;
    });

    $('input[name="subtotal"]').val(formatRupiah(subtotal));
    $('input[placeholder="total"]').val(formatRupiah(subtotal));

    const totalPayment =
        parseFloat($('input[name="total_payment"]').val()) || 0;
    const remainingPayment = subtotal - totalPayment;

    // Cek jika remainingPayment negatif dan format nilainya
    if (remainingPayment < 0) {
        // Format nilai dengan tanda minus setelah 'Rp'
        $('input[name="remaining_payment"]').val(
            "-" + formatRupiah(Math.abs(remainingPayment))
        );
        $('input[name="remaining_payment"]').css("color", "red"); // Mengubah warna teks menjadi merah
    } else {
        // Jika tidak negatif, tampilkan dengan format Rupiah biasa
        $('input[name="remaining_payment"]').val(
            formatRupiah(remainingPayment)
        );
        $('input[name="remaining_payment"]').css("color", "black"); // Mengembalikan warna teks ke normal
    }
}

// Tambahkan event listener pada input rate untuk memformat saat diinput
$(document).on("input", ".rate-input", function () {
    const inputVal = $(this).val();
    const formatted = formatRupiah(unformatRupiah(inputVal).toString());
    $(this).val(formatted);
});

// Tambahkan event listener pada perubahan input qty, rate, dan total_payment
$(document).on(
    "input",
    'input[name$="[qty]"], input[name$="[harga_item]"], input[name="total_payment"]',
    function () {
        calculateInvoice();
    }
);

// Panggil fungsi hitung invoice ketika halaman dimuat pertama kali
$(document).ready(function () {
    calculateInvoice();
});

document.getElementById("paymentForm").addEventListener("submit", function (e) {
    // Prevent form from submitting immediately
    e.preventDefault();

    // Get the data from the editor
    const paymentInstructions = editor.getData();

    // Update the textarea value with the editor content
    document.getElementById("payment_intructions").value = paymentInstructions;

    // Loop through each row in the invoice table
    $("#tableBody tr").each(function () {
        // Get rate and amount inputs, and convert them back to float
        const rateInput = $(this).find('input[name$="[harga_item]"]');
        const amountInput = $(this).find('input[name$="[amount]"]');

        // Remove Rupiah format and convert to float
        const rateValue = unformatRupiah(rateInput.val());
        const amountValue = unformatRupiah(amountInput.val());

        // Set the values back to the inputs
        rateInput.val(rateValue);
        amountInput.val(amountValue);
    });

    // Handle subtotal, total, and remaining_payment similarly
    const subtotalInput = $('input[name="subtotal"]');
    const totalInput = $('input[placeholder="total"]');
    const remainingPaymentInput = $('input[name="remaining_payment"]');

    subtotalInput.val(unformatRupiah(subtotalInput.val()));
    totalInput.val(unformatRupiah(totalInput.val()));
    remainingPaymentInput.val(unformatRupiah(remainingPaymentInput.val()));

    // Now submit the form
    this.submit();
});
