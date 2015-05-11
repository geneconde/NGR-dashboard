/**
 *  highlightRow and highlight are used to show a visual feedback. If the row has been successfully modified, it will be highlighted in green. Otherwise, in red
 */
function highlightRow(rowId, bgColor, after)
{
	var rowSelector = $("#" + rowId);
	rowSelector.css("background-color", bgColor);
	rowSelector.fadeTo("normal", 0.5, function() { 
		rowSelector.fadeTo("fast", 1, function() { 
			rowSelector.css("background-color", '');
		});
	});
}

function highlight(div_id, style) {
	highlightRow(div_id, style == "error" ? "#e5afaf" : style == "warning" ? "#ffcc00" : "#8dc70a");
}
        
/**
   updateCellValue calls the PHP script that will update the database. 
 */
function updateCellValue(editableGrid, rowIndex, columnIndex, oldValue, newValue, row, onResponse)
{      
	$.ajax({
		url: '../dashboard/subscriber/update.php',
		type: 'POST',
		dataType: "html",
		data: {
			tablename : editableGrid.name,
			id: editableGrid.getRowId(rowIndex), 
			newvalue: editableGrid.getColumnType(columnIndex) == "boolean" ? (newValue ? 1 : 0) : newValue, 
			colname: editableGrid.getColumnName(columnIndex),
			coltype: editableGrid.getColumnType(columnIndex)			
		},
		success: function (response) 
		{ 
			// reset old value if failed then highlight row
			var success = onResponse ? onResponse(response) : (response == "ok" || !isNaN(parseInt(response))); // by default, a sucessfull reponse can be "ok" or a database id 
			if (!success) editableGrid.setValueAt(rowIndex, columnIndex, oldValue);
		    highlight(row.id, success ? "ok" : "error"); 
		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true
	});
   
}
   


function DatabaseGrid() 
{ 
	var self = this;

	this.editableGrid = new EditableGrid("users", {
		enableSort: true,
	    // define the number of row visible by page
      	pageSize: 10,
      // Once the table is displayed, we update the paginator state
        tableRendered:  function() {  updatePaginator(this); },
   	    tableLoaded: function() { datagrid.initializeGrid(this); },
		modelChanged: function(rowIndex, columnIndex, oldValue, newValue, row) {
   	    	updateCellValue(this, rowIndex, columnIndex, oldValue, newValue, row);
   	    	self.fetchGrid();
   	    	$("#toolbar").load("manage-student-accounts.php #toolbar");
       	}
 	});
	this.fetchGrid(); 
	
}

DatabaseGrid.prototype.fetchGrid = function()  {
	// call a PHP script to get the data
	this.editableGrid.loadXML("loadstudentdata.php?db_tablename=users");
};

DatabaseGrid.prototype.initializeGrid = function(grid) {

  var self = this;

// render for the action column
	grid.setCellRenderer("action", new CellRenderer({ 
		render: function(cell, id) {                 
		      //cell.innerHTML+= "<i onclick=\"datagrid.deleteRow("+id+");\" class='fa fa-trash-o' ></i>";
		      cell.innerHTML+= "<a onclick=\"datagrid.deleteRow("+id+");\" href=\"#\" class='link'><i class='fa fa-trash-o' ></i> Delete</a> | ";
		      cell.innerHTML+= "<a href=\"view-portfolio.php?user_id="+id+"\" class='link'>View Portfolio</a>";
		}
	})); 

	// grid.setCellRenderer("trash", new CellRenderer({ 
	// 	render: function(cell, id) {                 
	// 	      cell.innerHTML+= "<a onclick=\"datagrid.softDelete("+id+");\" href=\"#\" class='link'>Trash</a>";
	// 	}
	// })); 

	// grid.setCellRenderer("password", new CellRenderer({ 
	// 	render: function(cell, id) {                 
	// 	      cell.innerHTML+= "<a href=\"change-pw.php?user_id="+id+"\" class='link'>Change Password</a>";
	// 	}
	// })); 

	grid.renderGrid("tablecontent", "testgrid");
};    

DatabaseGrid.prototype.deleteRow = function(id) 
{

  var self = this;
  //if ( confirm('Are you sure you want to delete the row id ' + id )  ) {
  if ( confirm('Are you sure you want to delete this user ?')  ) {

        $.ajax({
		url: '../dashboard/subscriber/delete.php',
		type: 'POST',
		dataType: "html",
		data: {
			tablename : self.editableGrid.name,
			id: id 
		},
		success: function (response) 
		{ 
			if (response == "ok" )
			{
		        self.editableGrid.removeRow(id);
		        //location.reload();
		        $("#toolbar").load("manage-student-accounts.php #toolbar");
			}

		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true
	});

        
  }
			
}; 

DatabaseGrid.prototype.softDelete = function(id) 
{

  var self = this;

  if ( confirm('Are you sure you want to move the row id ' + id + ' to the trash' )  ) {

  		var is_deleted = 1;

        $.ajax({
		url: '../dashboard/subscriber/.php',
		type: 'POST',
		dataType: "html",
		data: {
			tablename : self.editableGrid.name,
			id: id,
			is_deleted: is_deleted 
		},
		success: function (response) 
		{ 
			if (response == "ok" )
			{
				self.fetchGrid();
		        //location.reload();
			}

		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true
	});

        
  }
			
}; 


DatabaseGrid.prototype.addRow = function(id) 
{

  var self = this;

  		var gender = $('#gender').is(':checked') ? 'M' : 'F';

        $.ajax({
		url: '../dashboard/subscriber/add-student.php',
		type: 'POST',
		dataType: "html",
		data: {
			tablename : self.editableGrid.name,
			username: $("#username").val(),
			password: $("#password").val(),
			lastname:  $("#lastname").val(),
			firstname:  $("#firstname").val(),
			gender:  gender,
			grade_level:  $("#grade_level").val()
		},
		success: function (response) 
		{ 
			if (response == "ok" ) {
   
                // hide form
                showAddForm(); 
                $("#username").val('');
                $("#password").val('');  
        		$("#lastname").val('');
                $("#firstname").val('');
                $("#gender").val('');
                $("#grade_level").val('');
			    
                alert("Row added : reload model");
                self.fetchGrid();
                //location.reload();
                $("#toolbar").load("manage-student-accounts.php #toolbar");
           	}
            else 
              alert("error");
		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true
	});

        
			
}; 




function updatePaginator(grid, divId)
{
    divId = divId || "paginator";
	var paginator = $("#" + divId).empty();
	var nbPages = grid.getPageCount();

	// get interval
	var interval = grid.getSlidingPageInterval(20);
	if (interval == null) return;
	
	// get pages in interval (with links except for the current page)
	var pages = grid.getPagesInInterval(interval, function(pageIndex, isCurrent) {
		if (isCurrent) return "<span id='currentpageindex'>" + (pageIndex + 1)  +"</span>";
		return $("<a>").css("cursor", "pointer").html(pageIndex + 1).click(function(event) { grid.setPageIndex(parseInt($(this).html()) - 1); });
	});
		
	// "first" link
	var link = $("<a class='nobg'>").html("<i class='fa fa-fast-backward'></i>");
	if (!grid.canGoBack()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { grid.firstPage(); });
	paginator.append(link);

	// "prev" link
	link = $("<a class='nobg'>").html("<i class='fa fa-backward'></i>");
	if (!grid.canGoBack()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { grid.prevPage(); });
	paginator.append(link);

	// pages
	for (p = 0; p < pages.length; p++) paginator.append(pages[p]).append(" ");
	
	// "next" link
	link = $("<a class='nobg'>").html("<i class='fa fa-forward'>");
	if (!grid.canGoForward()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { grid.nextPage(); });
	paginator.append(link);

	// "last" link
	link = $("<a class='nobg'>").html("<i class='fa fa-fast-forward'>");
	if (!grid.canGoForward()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { grid.lastPage(); });
	paginator.append(link);
}; 

        

   




  



