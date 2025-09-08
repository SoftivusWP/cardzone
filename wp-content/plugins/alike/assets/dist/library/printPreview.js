jQuery(document).ready(function() {

	jQuery("#printbutton").click(function(e){
		html2canvas(jQuery("#alike-table-data"), {
	    onrendered: function(canvas) {
        const win = window.open();
        win.document.write(`<br><img src='${canvas.toDataURL()}'/>`);
        win.print();
        win.close();
		    }
		});             
	});
});