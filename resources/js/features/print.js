export default (imageUrl, imageName) => ({
    imageUrl: imageUrl,
    imageName: imageName,

    print() {
        const printWindow = window.open('', '_blank');

        printWindow.document.open();

        printWindow.document.write(
            '<html>' +
            '<head>' +
            '<title>' + this.imageName + '</title>' +
            '<style>body { margin: 0; padding: 20px; } img { max-width: 100%; height: auto; }</style>' +
            '<script>' +
            'function step1() { setTimeout(\'step2()\', 10); }' +
            'function step2() { window.print(); window.close(); }' +
            '</script>' +
            '</head>' +
            '<body onload=\'step1()\'>' +
            '<img src=\'' + this.imageUrl + '\' alt=\'' + this.imageName + '\'/>' +
            '</body>' +
            '</html>'
        );

        printWindow.document.close();
    }
});
