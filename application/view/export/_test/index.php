<div class="container padding-fix">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong style="line-height:26px;">Report -- <?php echo date(DATE_CUSTOM); ?></strong>
        </div>
        <div class="panel-body">
            <table class="tablesorter">
                <thead>
                <tr>
                    <th>Rank</th>
                    <th>Age</th>
                    <th class="total">Total (range)</th>
                    <th>Discount</th>
                    <th data-placeholder="Try 1/18/2013">Date (one input)</th>
                    <th>Date (two inputs; range)</th>
                </tr>
                </thead>
                <tbody>
                <tr><td>1</td><td>25</td><td>$5.95</td><td>22%</td><td>Jun 26, 2013 7:22 AM</td><td>Jun 26, 2013 7:22 AM</td></tr>
                <tr><td>11</td><td>12</td><td>$82.99</td><td>5%</td><td>Aug 21, 2013 12:21 PM</td><td>Aug 21, 2013 12:21 PM</td></tr>
                <tr><td>12</td><td>51</td><td>$99.29</td><td>18%</td><td>Oct 13, 2013 1:15 PM</td><td>Oct 13, 2013 1:15 PM</td></tr>
                <tr><td>51</td><td>28</td><td>$9.99</td><td>20%</td><td>Jul 6, 2013 8:14 AM</td><td>Jul 6, 2013 8:14 AM</td></tr>
                <tr><td>21</td><td>33</td><td>$19.99</td><td>25%</td><td>Dec 10, 2012 5:14 AM</td><td>Dec 10, 2012 5:14 AM</td></tr>
                <tr><td>013</td><td>18</td><td>$65.89</td><td>45%</td><td>Jan 12, 2013 11:14 AM</td><td>Jan 12, 2013 11:14 AM</td></tr>
                <tr><td>005</td><td>45</td><td>$153.19</td><td>45%</td><td>Jan 18, 2014 9:12 AM</td><td>Jan 18, 2014 9:12 AM</td></tr>
                <tr><td>10</td><td>3</td><td>$5.29</td><td>4%</td><td>Jan 8, 2013 5:11 PM</td><td>Jan 8, 2013 5:11 PM</td></tr>
                <tr><td>16</td><td>24</td><td>$14.19</td><td>14%</td><td>Jan 14, 2014 11:23 AM</td><td>Jan 14, 2014 11:23 AM</td></tr>
                <tr><td>66</td><td>22</td><td>$13.19</td><td>11%</td><td>Jan 18, 2013 9:12 AM</td><td>Jan 18, 2013 9:12 AM</td></tr>
                <tr><td>100</td><td>18</td><td>$55.20</td><td>15%</td><td>Feb 12, 2013 7:23 PM</td><td>Feb 12, 2013 7:23 PM</td></tr>
                <tr><td>55</td><td>65</td><td>$123.00</td><td>32%</td><td>Jan 20, 2014 1:12 PM</td><td>Jan 20, 2014 1:12 PM</td></tr>
                <tr><td>9</td><td>25</td><td>$22.09</td><td>17%</td><td>Jun 11, 2013 10:55 AM</td><td>Jun 11, 2013 10:55 AM</td></tr>
                <tr><td>13</td><td>12</td><td>$19.99</td><td>18%</td><td>Jan 20, 2014 7:45 PM</td><td>Jan 20, 2014 7:45 PM</td></tr>
                <tr><td>73</td><td>58</td><td>$129.19</td><td>39%</td><td>Jan 20, 2014 10:11 AM</td><td>Jan 20, 2014 10:11 AM</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function() {

        // call the tablesorter plugin
        $("table").tablesorter({
            headerTemplate : '{content}{icon}',
            // hidden filter input/selects will resize the columns, so try to minimize the change
            widthFixed : true,
            // initialize zebra striping and filter widgets
            widgets : ["zebra", "filter", "stickyHeaders", "uitheme"],
            widgetOptions : {
                // Use the $.tablesorter.storage utility to save the most recent filters
                filter_saveFilters : true,
                // jQuery selector string of an element used to reset the filters
                filter_reset : 'button.reset',
                // add custom selector elements to the filter row
                filter_formatter : {

                    // Rank (jQuery selector added v2.17.0)
                    'th:contains("Rank")' : function($cell, indx){
                        return $.tablesorter.filterFormatter.uiSlider( $cell, indx, {
                            delayed : true,
                            valueToHeader : false,
                            cellText : 'Rank:',
                            compare : [ '=', '>=', '<=' ],
                            selected : 2, // zero-based index of compare starting selected value
                            // jQuery UI slider options
                            value : 100,
                            min : 0,
                            max : 100
                        });
                    },

                    // Age
                    1 : function($cell, indx){
                        return $.tablesorter.filterFormatter.uiSlider( $cell, indx, {
                            delayed : false,
                            valueToHeader : false,
                            exactMatch : false,
                            allText : 'all', // this is ignored when compare is not empty
                            compare : [ '=', '>=', '<=' ],
                            selected : 1,
                            // jQuery UI slider options
                            value : 1,
                            min : 1,
                            max : 65
                        });
                    },

                    // Total (jQuery selector added v2.17.0)
                    '.total' : function($cell, indx){
                        return $.tablesorter.filterFormatter.uiRange( $cell, indx, {
                            delayed : false,
                            valueToHeader : false,
                            // jQuery UI slider options
                            values : [1, 160],
                            min : 1,
                            max : 160
                        });
                    },

                    // Discount
                    3 : function($cell, indx){
                        return $.tablesorter.filterFormatter.uiSpinner( $cell, indx, {
                            delayed : true,
                            addToggle : false,
                            exactMatch : true,
                            compare : [ '', '=', '>=', '<=' ],
                            selected : 2,
                            // jQuery UI spinner options
                            min : 0,
                            max : 45,
                            value : 1,
                            step : 1
                        });
                    },

                    // Date (one input)
                    4 : function($cell, indx){
                        return $.tablesorter.filterFormatter.uiDateCompare( $cell, indx, {
                            cellText : 'Dates', // text added before the input
                            compare : [ '', '=', '>=', '<=' ],
                            selected : 3,
                            // jQuery UI datepicker options
                            // defaultDate : '1/1/2014', // default date
                            changeMonth : true,
                            changeYear : true

                        });
                    },

                    // Date (two inputs)
                    5 : function($cell, indx){
                        return $.tablesorter.filterFormatter.uiDatepicker( $cell, indx, {
                            // from : '08/01/2013', // default from date
                            // to   : '1/18/2014',  // default to date
                            changeMonth : true,
                            changeYear : true
                        });
                    }
                },

                // added v2.16
                filter_placeholder : {
                    from : 'From...',
                    to   : 'To...'
                }
            }
        });

    });
</script>