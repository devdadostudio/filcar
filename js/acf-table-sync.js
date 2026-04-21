(function($) {
    if (typeof acf === 'undefined') return;

    // ================================================================
    // 1. FUNZIONE CONTENUTI (TABELLA PRINCIPALE) - RIPRISTINATA
    // ================================================================
    function eseguiSincronizzazione($row) {
        var $block = $row.closest('.acf-block-fields, .acf-fields, .editor-styles-wrapper');
        var $headings = $block.find('[data-key="field_69e62819eb6fa"] > .acf-input > .acf-repeater > .acf-table > tbody > .acf-row').not('.acf-clone');
        var $innerRepeater = $row.find('[data-key="field_69e62819eb705"]');
        var $addButtonMain = $innerRepeater.find('.acf-actions:last > .acf-button[data-event="add-row"]');

        if ($headings.length === 0) return;

        $innerRepeater.find('.acf-row').not('.acf-clone').remove();

        $headings.each(function(index) {
            var $currentHeading = $(this);
            setTimeout(function() {
                $addButtonMain.trigger('click');
                var $lastRow = $innerRepeater.find('.acf-row').not('.acf-clone').last();
                
                var headerType = $currentHeading.find('[data-key="field_69e62819eb6fb"] select').val();
                var rowType = (headerType === 'title-advanced') ? 'row-advanced' : (headerType === 'title-sub' ? 'row-sub' : 'row-normal');
                
                if (headerType === 'title-dimensions') {
                    rowType = 'row-dimensions';
                }

                $lastRow.find('[data-key="field_69e62819eb706"] select').val(rowType).trigger('change');

                if (rowType === 'row-advanced') {
                    var isCilindrata = $currentHeading.find('[data-key="field_69e62819eb6fd"] select').val() === 'Cilindrate';
                    var sourceRepeaterKey = isCilindrata ? 'field_69e62819eb6fe' : 'field_69e62819eb700';
                    var sourceFieldKey = isCilindrata ? 'field_69e62819eb6ff' : 'field_69e62819eb701';
                    
                    var $subs = $currentHeading.find('[data-key="' + sourceRepeaterKey + '"] .acf-row:not(.acf-clone)');
                    var $targetRepeater = $lastRow.find('[data-key="field_69e62819eb708"]');
                    var $subAddBtn = $targetRepeater.find('.acf-actions:last .acf-button');

                    $subs.each(function() {
                        var labelTesto = $(this).find('[data-key="' + sourceFieldKey + '"] select').val();
                        $subAddBtn.trigger('click');
                        $targetRepeater.find('.acf-row:not(.acf-clone)').last().find('[data-key="field_69e62819eb709"] input').val(labelTesto).trigger('change');
                    });
                }

                if (rowType === 'row-sub') {
                    var $subsSub = $currentHeading.find('[data-key="field_69e62819eb702"] .acf-row:not(.acf-clone)');
                    var $targetRepeaterSub = $lastRow.find('[data-key="field_69e62819eb70b"]');
                    var $subAddBtnSub = $targetRepeaterSub.find('.acf-actions:last .acf-button');

                    $subsSub.each(function() {
                        var labelSottotitolo = $(this).find('[data-key="field_69e62819eb703"] input').val();
                        $subAddBtnSub.trigger('click');
                        $targetRepeaterSub.find('.acf-row:not(.acf-clone)').last().find('[data-key="field_69e62819eb70c"] input').val(labelSottotitolo).trigger('change');
                    });
                }
            }, index * 300);
        });
    }

    // ================================================================
    // 2. FUNZIONE DIMENSIONI (FUNZIONANTE)
    // ================================================================
    function syncDimensioniConLabel($row) {
        var $block = $row.closest('.acf-block-fields, .acf-fields');
        var $headerRows = $block.find('[data-key="field_69e73ed872c53"] .acf-row:not(.acf-clone)');
        var $targetRep = $row.find('[data-key="field_69e73ed872c5e"]');
        var $addBtn = $targetRep.find('.acf-actions:last > .acf-button[data-event="add-row"]');

        if (!$headerRows.length || !$addBtn.length) return;

        $targetRep.find('.acf-row:not(.acf-clone)').remove();

        $headerRows.each(function(i) {
            var $wysiwyg = $(this).find('[data-key="field_69e73ed872c55"]');
            var rawVal = $wysiwyg.find('textarea').val() || "";
            var cleanText = rawVal.replace(/<\/?[^>]+(>|$)/g, "").trim();

            setTimeout(function() {
                $addBtn.trigger('click');
                var $newInnerRow = $targetRep.find('.acf-row:not(.acf-clone)').last();
                // Scrive in Etichetta colonna (field_69e74b1693b0e)
                $newInnerRow.find('[data-key="field_69e74b1693b0e"] input').val(cleanText).trigger('change');
            }, i * 150);
        });
    }

    // ================================================================
    // LISTENER CLICK
    // ================================================================
    $(document).on('click', '.acf-button[data-event="add-row"]', function() {
        var $field = $(this).closest('.acf-field');
        var key = $field.attr('data-key');

        if (key === 'field_69e62819eb704') {
            setTimeout(function() {
                var $newRow = $field.find('> .acf-input > .acf-repeater > .acf-table > tbody > .acf-row:not(.acf-clone)').last();
                if ($newRow.length) eseguiSincronizzazione($newRow);
            }, 500);
        }

        if (key === 'field_69e73ed872c5d') {
            setTimeout(function() {
                var $newRow = $field.find('> .acf-input > .acf-repeater > .acf-table > tbody > .acf-row:not(.acf-clone)').last();
                if ($newRow.length) syncDimensioniConLabel($newRow);
            }, 500);
        }
    });

})(jQuery);