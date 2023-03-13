jQuery(function($) {
	jQuery("#selectFile_button").click(function() {
		var selectFileSample4 = document.getElementById("selectFile");
		selectFileSample4.click();
	});
});

function changeSelectFileSample4() {
	// ファイル名のみ取得して表示
	var selectFileSample4 = document.getElementById("selectFile").value;
	var regex = /\\|\\/;
	var array = selectFileSample4.split(regex);
	document.getElementById("movie_load").value = array[array.length - 1];


}
