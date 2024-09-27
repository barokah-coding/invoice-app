import SignaturePad from "signature_pad";

document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("signature-pad");
    const signaturePad = new SignaturePad(canvas);

    document.getElementById("save-signature").addEventListener("click", () => {
        if (signaturePad.isEmpty()) {
            alert("Please provide a signature first.");
        } else {
            const dataURL = signaturePad.toDataURL();
            document.getElementById("signature-data").value = dataURL; // Simpan data URL ke input tersembunyi
            alert("Signature saved!");
        }
    });
});
