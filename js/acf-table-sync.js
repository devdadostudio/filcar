(function($) {
    if (typeof acf === 'undefined') return;

    function eseguiSincronizzazione($row) {
        var $block = $row.closest('.acf-block-fields, .acf-fields, .editor-styles-wrapper');
        
        // Sorgente: Repeater Titoli (field_69e1f115ec610)
        var $headings = $block.find('[data-key="field_69e1f115ec610"] > .acf-input > .acf-repeater > .acf-table > tbody > .acf-row').not('.acf-clone');
        
        // Destinazione: Repeater Righe interno (field_69e20630fee0f)
        var $innerRepeater = $row.find('[data-key="field_69e20630fee0f"]');
        var $addButtonMain = $innerRepeater.find('.acf-actions:last > .acf-button[data-event="add-row"]');

        if ($headings.length === 0) return;

        // Pulisce le righe esistenti
        $innerRepeater.find('.acf-row').not('.acf-clone').remove();

        $headings.each(function(index) {
            var $currentHeading = $(this);
            
            setTimeout(function() {
                $addButtonMain.trigger('click');
                var $lastRow = $innerRepeater.find('.acf-row').not('.acf-clone').last();
                
                // Leggi Tipo Heading e imposta Tipo Colonna
                var headerType = $currentHeading.find('[data-key="field_69e1f151ec611"] select').val();
                var rowType = (headerType === 'title-advanced') ? 'row-advanced' : (headerType === 'title-sub' ? 'row-sub' : 'row-normal');
                $lastRow.find('[data-key="field_69e2030f944f1"] select').val(rowType).trigger('change');

                // --- 1. CASO CILINDRATE / FLUIDI ---
                if (rowType === 'row-advanced') {
                    var isCilindrata = $currentHeading.find('[data-key="field_69e1f237ec613"] select').val() === 'Cilindrate';
                    var sourceRepeaterKey = isCilindrata ? 'field_69e1f2bbec614' : 'field_69e1f3d3ec618';
                    var sourceFieldKey = isCilindrata ? 'field_69e1f35fec616' : 'field_69e1f3d3ec619';
                    
                    var $subs = $currentHeading.find('[data-key="' + sourceRepeaterKey + '"] .acf-row:not(.acf-clone)');
                    var $targetRepeater = $lastRow.find('[data-key="field_69e2030f944f3"]');
                    var $subAddBtn = $targetRepeater.find('.acf-actions:last .acf-button');

                    $subs.each(function() {
                        // Legge il valore della Select (es. "Motoveicoli")
                        var labelTesto = $(this).find('[data-key="' + sourceFieldKey + '"] select').val();
                        
                        $subAddBtn.trigger('click');
                        var $newSubRow = $targetRepeater.find('.acf-row:not(.acf-clone)').last();
                        
                        // Scrive in Etichetta compatibilità (field_69e24e32ab2c7)
                        $newSubRow.find('[data-key="field_69e24e32ab2c7"] input').val(labelTesto).trigger('change');
                    });
                }

                // --- 2. CASO SOTTOTITOLI ---
                if (rowType === 'row-sub') {
                    var $subsSub = $currentHeading.find('[data-key="field_69e1f4f089b4a"] .acf-row:not(.acf-clone)');
                    var $targetRepeaterSub = $lastRow.find('[data-key="field_69e2030f944f8"]');
                    var $subAddBtnSub = $targetRepeaterSub.find('.acf-actions:last .acf-button');

                    $subsSub.each(function() {
                        // Legge il testo da Sottotitolo (field_69e1f52989b4b)
                        var labelSottotitolo = $(this).find('[data-key="field_69e1f52989b4b"] input').val();
                        
                        $subAddBtnSub.trigger('click');
                        var $newSubRowSub = $targetRepeaterSub.find('.acf-row:not(.acf-clone)').last();
                        
                        // Scrive in Etichetta sottocolonna (field_69e24e77ab2c8)
                        $newSubRowSub.find('[data-key="field_69e24e77ab2c8"] input').val(labelSottotitolo).trigger('change');
                    });
                }

            }, index * 300); // Leggermente più lento per sicurezza
        });
    }

    $(document).on('click', '.acf-button[data-event="add-row"]', function() {
        var $field = $(this).closest('.acf-field');
        if ($field.attr('data-key') === 'field_69e2030f944f0') {
            setTimeout(function() {
                var $newRow = $field.find('.acf-row').not('.acf-clone').last();
                if ($newRow.length) eseguiSincronizzazione($newRow);
            }, 500);
        }
    });

})(jQuery);