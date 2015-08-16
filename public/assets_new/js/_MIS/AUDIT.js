function DoCellData(cell, row, col, data) {}
function DoBeforeAutotable(table, headers, rows, AutotableSettings) {}

function doExport(selector, params) {
    var options = {tableName: 'Logs',
        fileName: file,
        htmlContent: true,
        worksheetName: 'Audit Trail Records',
        jspdf: {orientation: 'l',
            autotable: {extendWidth: false, overflow: 'linebreak',
                        padding: 6,
                        lineHeight: 18,
                        fontSize: 8,
                        tableExport: {onBeforeAutotable: DoBeforeAutotable,
                                      onCellData: DoCellData}}}
        };
    $.extend(true, options, params);
    $(selector).tableExport(options);
}

function doExportPDF(selector, params) {
    var options = {tableName: 'Logs',
        fileName: file,
        htmlContent: false,
        worksheetName: 'Audit Trail Records',
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