
var heading1box, heading2box, eventbox;
(function($) {
    $(document).ready(function() {
        heading1box = $('textarea[name="timetable_settings[timetable_text_field_headers_1]"]');
        heading2box = $('textarea[name="timetable_settings[timetable_text_field_headers_2]"]');
        eventbox = $('textarea[name="timetable_settings[timetable_textarea_field_times]"]');

        const closeButton = "<button class='button-admin button-admin-close'>X</button>";
        const newButton = "<button class='button-admin button-admin-new'>+</button>";

        function box_selector(heading)
        {
            return "js-" + heading + "-heading-box";
        }

        function wrapper_selector(type)
        {
            return "js-" + type + "-box-wrapper";
        }
        
        function toggle_php_box(box)
        {
            box.toggle();
        }

        /**
         * jQuery element to enter text that will update `phpBox` when a user types text.
         * Also adds close button
         */
        function create_cell_box(phpBox, heading_number, box_text)
        {
            var box = $("<input class='" + box_selector(heading_number) + " js-header-box' value='" + box_text + "'/>");
            var close = $(closeButton);

            $(close).on("click", function(e) {
                e.preventDefault();
                $(close).remove();
                $(box).remove();
                update_header_box(phpBox, heading_number);
            });

            $(box).keyup(function() {
                update_header_box(phpBox, heading_number);
            });

            var wrapper = $("<span class='cell-box-wrapper'></span>").append(box);
            wrapper.append(close);
            return wrapper;
        }

        function create_wrapper_with_class(firstElement, secondElement, type)
        {
            var wrapper = $("<div class='" + wrapper_selector(type) + "'></div>");
            wrapper.append(firstElement);
            if (secondElement !== null) {
                wrapper.append(secondElement);
            }
            return wrapper;
        }

        /**
         * Adds Plus and Minus editing buttons to a header.
        */
        function add_header_editing_buttons(phpBox, number)
        {
            if (phpBox.length === 0) { return; }
            var headings = phpBox[0].value.split(",");
            var headingsNewBoxes = headings.map(function(text) { 
                return create_cell_box(phpBox, number, text);
            });

            var newBtn = $(newButton);
            newBtn.on("click", function(e) {
                e.preventDefault();
                $(phpBox).text += ",";
                var newBox = create_cell_box(phpBox, number, "");
                headingsNewBoxes.push(newBox); // Unsure if we need to add to this array
                $(e.currentTarget).before(newBox);
            });

            phpBox.after(create_wrapper_with_class(headingsNewBoxes, newBtn, number + "-heading"));            
        }

        /**
         * Update the given `box` from the boxes cell contents
         * based on `number`.
         */
        function update_header_box(box, number)
        {
            console.log("Updating header box")
            var contents = [];
            $('.' + box_selector(number)).each(function() {
                console.log("Updating header box 2")
                var cell = $(this)[0].value;
                contents.push(cell);
            });
            console.log(contents.join(","))
            $(box).text(contents.join(","));
        }


        /**
         * Creates boxes for the timetable events.
         */
        function add_event_boxes()
        {
            if (eventbox.length === 0) { return; }
            var eventwrapper = $("<div class='js-event-wrapper'></div>");
            eventbox.after(eventwrapper);

            var contents = eventbox[0].value.split("\n");
            var gridboxes = contents.map(function(row) {
                var therow = row.split(",").map(function(celltext) {
                    var cell = $("<input class='js-event-cell js-editable-cell' value='" + celltext + "'/>");
                    $(cell).keyup(function() {
                        update_event_box();
                    });
                    return cell;
                });
                let rowwrap = $("<div class='js-event-row'></div>");
                rowwrap.append(therow);
                return rowwrap;
            });

            gridboxes.forEach(cell => {
                eventwrapper.append(cell);
            });
        }

        function update_event_box()
        {
            var contents = [];
            $(".js-event-wrapper .js-event-row").each(function() {
                var contentsrow = [];
                $(this).find(".js-event-cell").each(function(i, val) {
                    var cell = $(val)[0].value;
                    contentsrow.push(cell);
                })
                contents.push(contentsrow.join(","));
            });
            $(eventbox).text(contents.join("\n"));
        }

        function setup_csv_data_toggle(boxes)
        {
            $(".js-show-csv-data").on("click", function(e) {
                e.preventDefault();
                boxes.forEach(function(box) {
                    toggle_php_box(box);
                });
            });
        }

        function main()
        {
            toggle_php_box(heading1box);
            toggle_php_box(heading2box);
            toggle_php_box(eventbox);
            setup_csv_data_toggle([
                heading1box,
                heading2box,
                eventbox
            ]);
            add_header_editing_buttons(heading1box, "1");
            add_header_editing_buttons(heading2box, "2");
            add_event_boxes();
        }

        main();
    });
})(jQuery);
