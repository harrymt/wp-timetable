
var heading1box, heading2box;
(function($) {
    $( document ).ready(function() {
        heading1box = $('textarea[name="timetable_settings[timetable_text_field_headers_1]"]');
        heading2box = $('textarea[name="timetable_settings[timetable_text_field_headers_2]"]');

        const closeButton = "<button class='button-admin button-admin-close'>X</button>";
        const newButton = "<button class='button-admin button-admin-new'>+</button>";

        function create_cell_box(phpBox, heading_number, box_text, box_number)
        {
            var box = $("<input class='js-" + heading_number + "-heading-box js-" + heading_number + "-heading-box-" + box_number + "' value='" + box_text + "'/>");
            var close = $(closeButton);

            $(close).on("click", function(e) {
                e.preventDefault();
                $(close).remove();
                $(box).remove();
                updatePHPBoxWithNewHeaders(phpBox, heading_number);
            });

            $(box).keyup(function(e) {
                console.log("Edited box", box_number, "with", e.key)
                updatePHPBoxWithNewHeaders(phpBox, heading_number);
            });

            var wrapper = $("<span class='heading-box-wrapper'></span>").append(box);
            wrapper.append(close);
            return wrapper;
        }

        /**
         * Adds Plus and Minus editing buttons to a header
        */
        function add_header_editing_buttons(phpBox, number) {
            if (phpBox.length === 0) { return; }
            var headings = phpBox[0].value.split(",");
            var headingsNewBoxes = headings.map((text, i) => create_cell_box(phpBox, number, text, i));

            var newBtn = $(newButton);
            newBtn.on("click", function(e) {
                e.preventDefault();
                $(phpBox).text += ",";
                var newBox = create_cell_box(phpBox, number, "", headingsNewBoxes.length);
                headingsNewBoxes.push(newBox);
                $(e.currentTarget).before(newBox);
            });

            var wrapper = $("<div class='js-" + number + "-headings-boxes'></div>");
            phpBox.after(wrapper);
            wrapper.append(headingsNewBoxes);
            wrapper.append(newBtn);
        }

        function updatePHPBoxWithNewHeaders(box, number) {
            var newHeaders = [];
            jQuery('.js-' + number + '-heading-box').each(function() {
                newHeaders.push(jQuery(this)[0].value);
            });
            console.log("Updating box", box, "with", newHeaders);
            $(box).text(newHeaders.join(","));
        }

        function hide_header(box) {
            box.css("display", "none");
        }

        hide_header(heading1box);
        hide_header(heading2box);
        add_header_editing_buttons(heading1box, "1");
        add_header_editing_buttons(heading2box, "2");
    });
})(jQuery);
