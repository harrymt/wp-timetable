
var heading1box, heading2box;
(function($) {
    $(document).ready(function() {
        heading1box = $('textarea[name="timetable_settings[timetable_text_field_headers_1]"]');
        heading2box = $('textarea[name="timetable_settings[timetable_text_field_headers_2]"]');

        const closeButton = "<button class='button-admin button-admin-close'>X</button>";
        const newButton = "<button class='button-admin button-admin-new'>+</button>";

        function box_selector(heading)
        {
            return "js-" + heading + "-heading-box";
        }

        function wrapper_selector(heading)
        {
            return "js-" + heading + "-heading-box-wrapper";
        }
        
        function hide_php_box(box)
        {
            box.css("display", "none");
        }

        /**
         * jQuery element to enter text that will update `phpBox` when a user types text.
         * Also adds close button
         */
        function create_cell_box(phpBox, heading_number, box_text)
        {
            var box = $("<input class='" + box_selector(heading_number) + "' value='" + box_text + "'/>");
            var close = $(closeButton);

            $(close).on("click", function(e) {
                e.preventDefault();
                $(close).remove();
                $(box).remove();
                updateBoxWithCellContents(phpBox, heading_number);
            });

            $(box).keyup(function(e) {
                updateBoxWithCellContents(phpBox, heading_number);
            });

            var wrapper = $("<span class='cell-box-wrapper'></span>").append(box);
            wrapper.append(close);
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

            var wrapper = $("<div class='" + wrapper_selector(number) + "'></div>");
            phpBox.after(wrapper);
            wrapper.append(headingsNewBoxes);
            wrapper.append(newBtn);
        }

        /**
         * Update the given `box` from the boxes cell contents
         * based on `number`.
         */
        function updateBoxWithCellContents(box, number)
        {
            var contents = [];
            $('.' + box_selector(number)).each(function() {
                var cell = $(this)[0].value;
                contents.push(cell);
            });
            $(box).text(contents.join(","));
        }

        function main()
        {
            hide_php_box(heading1box);
            hide_php_box(heading2box);
            add_header_editing_buttons(heading1box, "1");
            add_header_editing_buttons(heading2box, "2");
        }

        main();
    });
})(jQuery);
