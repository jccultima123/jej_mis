function doExport(selector, params) {
    var options = {tableName: 'Assets',
        fileName: file,
        htmlContent: false,
        worksheetName: 'Consists of Asset Records'};
    $.extend(true, options, params);
    $(selector).tableExport(options);
}

function DoCellData(cell, row, col, data) {}
function DoBeforeAutotable(table, headers, rows, AutotableSettings) {}

function doExportPDF(selector, params) {
    var options = {tableName: 'Assets',
        fileName: file,
        htmlContent: false,
        worksheetName: 'Consists of Asset Records',
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