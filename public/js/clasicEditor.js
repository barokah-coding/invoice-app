let editor;

ClassicEditor.create(document.querySelector("#payment_intructions"))
    .then((newEditor) => {
        editor = newEditor;
    })
    .catch((error) => {
        console.error(error);
    });

document.getElementById("paymentForm").addEventListener("submit", function (e) {
    // Prevent form from submitting immediately
    e.preventDefault();

    // Get the data from the editor
    const paymentInstructions = editor.getData();

    // Update the textarea value with the editor content
    document.getElementById("payment_intructions").value = paymentInstructions;

    // Now submit the form
    this.submit();
});
let terms;
ClassicEditor.create(document.querySelector("#terms"))
    .then((newEditor) => {
        terms = newEditor;
    })
    .catch((error) => {
        console.error(error);
    });

document.getElementById("paymentForm").addEventListener("submit", function (e) {
    // Prevent form from submitting immediately
    e.preventDefault();

    // Get the data from the editor
    const termData = terms.getData();

    // Update the textarea value with the editor content
    document.getElementById("terms").value = termData;

    // Now submit the form
    this.submit();
});
