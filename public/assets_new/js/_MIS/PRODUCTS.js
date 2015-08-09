function doExport(selector, params) {
    var options = {tableName: 'Products',
        fileName: file,
        htmlContent: false,
        worksheetName: 'Official List of Products'};
    $.extend(true, options, params);
    $(selector).tableExport(options);
}

function DoCellData(cell, row, col, data) {}
function DoBeforeAutotable(table, headers, rows, AutotableSettings) {}

function doExportPDF(selector, params) {
    var options = {tableName: 'Assets',
        fileName: file,
        htmlContent: true,
        worksheetName: 'Official List of Products',
        jspdf: {orientation: 'l',
                autotable: {extendWidth: true,
                            tableExport: {onBeforeAutotable: DoBeforeAutotable,
                                          onCellData: DoCellData}}}
        };
    $.extend(true, options, params);
    $(selector).tableExport(options);
}
var header = function (doc, pageCount, options) {
    doc.text("header", options.margins.horizontal, doc.autoTableEndPosY() - doc.internal.getLineHeight() / 2);
};
var footer = function (doc, lastCellPos, pageCount, options) {
    doc.text("footer", options.margins.horizontal, doc.autoTableEndPosY() + doc.internal.getLineHeight());
};