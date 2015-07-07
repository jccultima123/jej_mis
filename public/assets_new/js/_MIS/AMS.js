function doExport(selector, params) {
    var options = {tableName: 'Assets',
        fileName: file,
        htmlContent: false,
        worksheetName: 'Consists of Asset Records'};
    $.extend(true, options, params);
    //$('#mixspans').tableExport(options);
    $(selector).tableExport(options);
}
var header = function (doc, pageCount, options) {
    doc.text("header", options.margins.horizontal, doc.autoTableEndPosY() - doc.internal.getLineHeight() / 2);
};
var footer = function (doc, lastCellPos, pageCount, options) {
    doc.text("footer", options.margins.horizontal, doc.autoTableEndPosY() + doc.internal.getLineHeight());
};