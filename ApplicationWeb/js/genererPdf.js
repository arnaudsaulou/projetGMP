let genererPDFAvecHTML = function(html, nom) {
    let opt = {
        filename:     nom + '.pdf',
        image:        { type: 'png' },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'cm', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(html).save();
};

let genererPreviewPdf = function(html) {
    let opt = {
        image:        { type: 'png' },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'cm', format: 'a4', orientation: 'portrait' }
    };
    return html2pdf().set(opt).from(html).outputImg();
};

let supprimerInputs = function(html) {
    let htmlObject = document.createElement('div');
    htmlObject.innerHTML = html;
    let inputs = htmlObject.getElementsByTagName("input");
    while (inputs.length) inputs[0].parentNode.removeChild(inputs[0]);
    return htmlObject.innerHTML;
};