/**
 * Objetos DOM
 * lstNonSelected -> lista desplegable donde aparecen las abreviaturas de los materiales disponibles
 * lstSelected -> lista desplegable donde aparecen los materiales seleccionados
 */

//On Ready
$(document).ready(function() 
{
	//Double click settings for the LIST items
	$("select[name*='lstNonSelected']").dblclick(function() 
	{
		MoveToSelection();
	});

	$("select[name*='lstSelected']").dblclick(function() 
	{
  		MoveFromSelection();
	});
});

    /**
     * TODO esta función no sé para que diablos se utiliza
     */
    //Set The Default Selected
    function SetTheDefaultSelected() 
    {
        //Select Pay Codes
        if ($("input[name*='txtSelected']").val() != "") 
        {
            //On the basis of value select the options
            var txt = $("input[name*='txtSelected']").val().split(',');
            //On the basis of value select the options
            for (var i = 0; i < txt.length; i = i + 1) 
            {

                //Get the values
                var val = $("select[name*='lstNonSelected'] option:[value='" + txt[i] + "']").val();
                var text = $("select[name*='lstNonSelected'] option:[value='" + txt[i] + "']").text();

                //Insert a new option
                $("select[name*='lstSelected']").append("<option value='" + val + "'>" + text + "</option>");

                //Remove the first list box
                $("select[name*='lstNonSelected'] option:[value='" + txt[i] + "']").remove();

            }
        }
    }

    //Move to Selection box
    function MoveToSelection() 
    {
    	MoveTheOptions($("select[name*='lstNonSelected']").attr("id"), $("select[name*='lstSelected']").attr("id"));
    }

    //Move from Selection box
    function MoveFromSelection() 
    {
    	MoveTheOptions($("select[name*='lstSelected']").attr("id"), $("select[name*='lstNonSelected']").attr("id"));
    }

    //Swap the values
    function MoveTheOptions(listBox1, listBox2) 
    {
        //Check if the list box is having any options selected
        if ($("#" + listBox1 + " option:selected").val() == null) 
        {
        	alert("Please select an option.");
        	return;
        }

        //Get iteself to an array
        var arr = $("#" + listBox1 + "  option:selected").map(function() { return "<option value='" + $(this).val() + "'>" + $(this).text() + "</option>"; });

        //Insert a new option(s)
        $("#" + listBox2 + "").append($.makeArray(arr).join(""));

        //Remove the first list box
        $("#" + listBox1 + "  option:selected").remove();

        //Refills the paycodes
        RefillHiddenTextBox();
    }

    //Refills the txt pay codes
    function RefillHiddenTextBox() 
    {
        // IMPORTANTE-> obtiene todos los elemntos seleccionados por comas
        var txt = $("select[name*='lstSelected'] option").map(function() { return this.value }).get().join(",");


        // Borramos los items
        var miLI = $('<li></li>', {
        	id: 'newTagInput'
        });
        $('#ulTags').empty();
        $('#ulTags').append(miLI);

        $("select[name*='lstSelected'] option").each(function(i, selected){
            //$('#ulTags').appendTo( $(insertTag($(selected).text())) );
            $(insertTag( $.trim($(selected).text()) )).insertBefore("#newTagInput");
        });
    }

    function insertTag(tag) {
    	var liEl = '<li id="tag-'+tag+'" class="li_tags">'+
    	'<span href="javascript://" class="a_tag">'+tag+'</span>&nbsp;'+
    	'</li>';
    	return liEl;
    }

    //Moves the options up or down using the buttons on the right hand side of the Selected List
    function MoveUpOrDown(isUp) 
    {
    	var listbox = $("select[name*='lstSelected']");

    	if ($(listbox).find("option:selected").length == 0) 
    	{
    		alert("You need to select atleast one selection.");
    	}
    	else if ($(listbox).find("option:selected").length > 1) 
    	{
    		alert("You can only select one option to move Up or Down.");
    	}
    	else 
    	{
            //Get the values
            var val = $(listbox).find("option:selected").val();
            var text = $(listbox).find("option:selected").text();
            var index = $(listbox).find("option:selected").index();

            //Get the length now
            var length = $(listbox).find("option").length;

            //Move it up or down
            if (isUp == true) 
            {
                //Move the option a row above
                index = (index == 0 ? index : index - 1);
                //Insert the options
                $("<option value='" + val + "'>" + text + "</option>").insertBefore($(listbox).find("option:eq(" + index + ")"));
            }
            else // Down
            {
                //Move the option a row down
                index = (index == length - 1 ? index : index + 1);

                $("<option value='" + val + "'>" + text + "</option>").insertAfter($(listbox).find("option:eq(" + index + ")"));
            }

            //Remove the options
            $(listbox).find("option:selected").remove();

            //Set the value as selected
            $(listbox).val(val);

            //Refill the textbox
            RefillHiddenTextBox();
        }
    }

    function cargarMaterial()
    {
   		var material = $('#form_lstSelected option');

   		var values = material.map(function() { 
            			return this.text; 
    	    		}).get().join('||');

		$('#form_material').val(values);
    }