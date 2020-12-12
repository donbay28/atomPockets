
var fInput = function() {
	var ele_render = function (id, field, item, escape) {
		ele = '';
		$.each(field, function(k, cls) {
			console.log(k);
			console.log(escape(item[k]));
			ele += '<div class="'+ cls +'" style="padding-left: 4px;">' +	
						'<p style="padding-bottom:1px !important;"><strong>'+ escape(item[k]) +'</strong></p>' + 
					'</div>';
		});
		return '<div class="col-xs-12" style="border-top :1px solid #ccc; padding: 0px !important">'+ ele +'</div>';
	};
	
    var modal_edit = function (a, b) {
        $("#section_modal .modal-header").addClass('modal-header-primary');
        $("#section_modal .modal-header").html('Edit '+ $('.page-title').text());
        $("#section_modal").modal('show');
        $("#section_modal .modal-body").load(b+a);
        $("#section_modal .modal-footer").hide();
    }

    var modal_delete = function(a) {
        var id = $(a).attr('id_data');
        $("#section_modal .modal-header").addClass('modal-header-danger');
        $("#section_modal .modal-dialog").addClass('modal-sm');
        $("#section_modal .modal-header").html('Delete '+ $('.page-title').text());
        $('#btn-modal-action').attr('id_data', id);
        $('#btn-modal-action').addClass('btn-danger');
        $('#btn-modal-action').text('Delete');
        $("#section_modal").modal('show');
        $("#section_modal .modal-body").html('Are you sure to delete data: "'+$('#list_'+id).find('.nama').text()+'" ?');
    }

    var submit = function(a, b) {
        var sts_submit = true;
        
        $('#'+a+' .data_input').each(function(i, obj) {
            ele = $(this);
            if (ele.attr('required') && ele.val() == '') {
				console.log(ele.attr('name'));
                ele.focus();
                sts_submit = false;
				
				d = ele.attr('placeholder');
				if (d) message = d +' can not be empty. You have to assign the value first!';
				else message = 'There is empty value on your input data. You have to assign the value first!';
				set_alert('alert-danger', '000', message);
				waitingDialog.hide();
                return false;
            }
        });        
		
        $('#'+a+' .date').each(function(i, obj) {
            ele = $(this);
            if (ele.attr('required') && (ele.val() == '__-__-____' || ele.val() == '__/__/____')) {
                console.log(ele.attr('name'));
				ele.focus();
                sts_submit = false;
				
				d = ele.attr('placeholder');
				if (d) message = d +' can not be empty. You have to assign the value first!';
				else message = 'There is empty value on your input data. You have to assign the value first!';
				set_alert('alert-danger', '001', message);
				waitingDialog.hide();
                return false;
            }
        });
                
        $('#'+a+' .data_selectize').each(function() {
            if ($(this).find('.selectized').val() == '' && $(this).find('.selectized').attr('req') == '1') {
				var name = $(this).find('.selectized').attr('id');
                var d = $(this).find('.selectized').attr('placeholder');
                $selectize = window[name];
				console.log(name);
				
                $selectize[0].selectize.focus();
                
                sts_submit = false;
				
				if (d) message = d +' can not be empty. You have to assign the value first!';
				else message = 'There is empty value on your input data. You have to assign the value first!';
				set_alert('alert-danger', '001', message);
				waitingDialog.hide();
                return false;
            }
        });
        
        if (sts_submit) {
            var url = $("#"+a).attr("action");
            
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: $("#"+a).serialize(), 
                success: function(data) {
                    if (data) {
						$('#alert_section').html(data[1]);
                        if (data[0]) {
                            if (b) {
                                myFuncs[b](data);
								return;
							}
                        }
                    }		
					waitingDialog.hide();
                },
                error: function(xhr, status, error) {
                    var $response = $(xhr.responseText);				
                    var dev_error_number = $response.find('p').eq(0).text();
                    var dev_error_message = $response.find('p').eq(1).text();
                    
					set_alert('alert-danger', dev_error_number, dev_error_message);
					waitingDialog.hide();
                }
            });
            
        } else {
			waitingDialog.hide();
			return false;
		}
	}
 
	var do_ajax = function(a, b, c) {
		
		$.ajax({
			url: a,
			type: 'POST',
			dataType: 'json',
			data: c,
			success: function(data) {
				if(data.alert) {
					$('#alert_section').html(data.alert);
				}
				if (b) {
                    myFuncs[b](c, data);
					return;
                }			
				waitingDialog.hide();
            },
            error: function(xhr, status, error) {
                var $response = $(xhr.responseText);				
                var dev_error_number = $response.find('p').eq(0).text();
                var dev_error_message = $response.find('p').eq(1).text();
                
				set_alert('alert-danger', dev_error_number, dev_error_message);
				waitingDialog.hide();
            }
		});
	}
	
	var set_alert = function(a, b, c) { // class, title, message
		var ele ='<div class=\"alert '+a+' alert-dismissible\" role=\"alert\" >\
					<a class="close" data-dismiss="alert" href="#">&times;</a>\
					\n <strong>'+b+'</strong> '+c+'</div>';
		$('#alert_section').html(ele);
	}
	
	var create_static_selectize = function(id, selectOptions, selectDropdown, selectCallback, selectCreate, m)  { // m: maxItems
		var post_data = {
			or_like: {}
		};			
		if(!m) m = 1;
		if(!selectCreate) selectCreate = false;
		if(!selectDropdown) selectDropdown = null;
		
		return $('#'+id).selectize({
			maxItems: m,
			placeholder: $('#'+id).attr('placeholder'),
			valueField: $('#'+id).attr('valueField'),
			labelField: $('#'+id).attr('labelField'), 
			searchField: $('#'+id).attr('searchField'),
			create: selectCreate,
			dropdownParent: selectDropdown,
			render: {
				option: function(item, escape){						
					// setting render show
					fields = {};
					showFields = $('#'+id).attr('showFields');
					classFields = $('#'+id).attr('classFields');
					if (showFields) {
						var arr_show = showFields.split(",");
						var arr_class = classFields.split(",");
						$.each(arr_show, function (i, f) {
							fields[f] = arr_class[i];
						});
					} else {
						fields[$('#'+id).attr('labelField')] = 'col-xs-12';
					}
					
					// create render options
					var ele = '';
					$.each(fields, function(k, cls) {
						ele += '<div class="'+ cls +'" style="padding-left: 4px;">' +	
									'<p style="padding-bottom:1px !important;"><strong>'+ escape(item[k]) +'</strong></p>' + 
								'</div>';
					});
					return '<div class="col-xs-12" style="border-top :1px solid #ccc; padding: 0px !important">'+ ele +'</div>';
				},
			},
			options: selectOptions, 
			onItemAdd: function(value, $item){
				var obj = this.options[value];
				if (selectCallback) {
					myFuncs[selectCallback]('onItemAdd', id, obj);
				}
			},
			onDelete : function(values) {
				var obj = this.options[values];
				if (selectCallback) {
					myFuncs[selectCallback]('onDelete', id, obj);
				}
			},
			onItemRemove : function(values) {
				var obj = this.options[values];
				if (selectCallback) {
					myFuncs[selectCallback]('onItemRemove', id, obj);
				}
			}
		}); 
	}
	
	// function(id, selectDropdown, selectCallback)
	var create_ajax_selectize = function(id, selectDropdown, selectCallback)  {
		var post_data = {
			or_like: {},
			like: {},
		};	
		
		maxItems = $('#'+id).attr('maxItems');
		if (!maxItems) maxItems = 1;
		
		var selectizeVariable = {
			maxItems: maxItems,
			placeholder: $('#'+id).attr('placeholder'),
			valueField: $('#'+id).attr('valueField'),
			labelField: $('#'+id).attr('labelField'),
			width: '50%',
			load: function(query, callback){
				this.clearOptions();
				this.clearCache();
				if (!query.length) return callback();
				
				// Replace word for variable
				var wordReplace = $('#'+id).attr('wordReplace');
				if (wordReplace)
					var wordtoReplace = $('#'+id).attr('wordtoReplace');
				else {
					wordReplace = '';
					wordtoReplace = '';
				}
				
				// deklarasi fields yang digunakan untuk search
				var searchField = $('#'+id).attr('searchField');
				var arr_search = searchField.split(",");
				$.each(arr_search, function (i, obj) {
					// post_data.or_like[obj] = query;
					post_data.like[obj] = query;
				});
						
				// deklarasi fields untuk filter data post
				var dataField = $('#'+id).attr('dataField');
				if (dataField) {
					var arr_data = dataField.split(",");
					$.each(arr_data, function (i, obj) {
						$('.'+obj).each(function() {
							post_data[$(this).attr('field')] = $(this).val();
						});
					});
				}
					
				// deklarasi fields untuk filter data post
				var dataNotIn = $('#'+id).attr('dataNotIn');
				if (dataNotIn) {
					var arr_data = dataNotIn.split(",");
					if ($('.'+arr_data[0]).length > 0) post_data['not_in'] = {};
					$.each(arr_data, function (i, obj) {
						post_data.not_in[obj] = {};
						$('.'+obj).each(function(i) {
							post_data.not_in[obj][i] = $(this).val();
						});
					});
				}
				
				// deklarasi fields yang digunakan untuk parent fields data pos
				var parentField = $('#'+id).attr('parentField');
				if (parentField) {
					var arr_parent = parentField.split(",");
					$.each(arr_parent, function (i, obj) {
						if($("#"+obj).val() == "") {
							set_alert('alert-danger', 'Warning:', 'Selectize dependency for field "'+$('#label-'+obj).text()+'" can not be empty. Fill the field first!');
							
							if ($('#'+arr_parent[0]).hasClass('selectized'))
								$('#'+arr_parent[0])[0].selectize.focus();
							else $('#'+arr_parent[0]).focus();								
							
							return false;
						}
						par = obj.replace("_update", "");
						post_data[par] = $("#"+obj).val();
					});
				}
					
				// deklarasi fields yang digunakan untuk parent fields data pos
				var reffField = $('#'+id).attr('reffField');
				if (reffField) {
					var arr_reff = reffField.split(",");
					$.each(arr_reff, function (i, obj) {
						console.log($("#"+obj).val());
						if($("#"+obj).val() != "") {
							par = obj.replace("_update", "");
							par = obj.replace(wordReplace, wordtoReplace); // untuk ktp
							post_data[par] = $("#"+obj).val();
						}
					});
				}
						
				$.ajax({
					url: site_url+$('#'+id).attr('url'),
					type: 'POST',
					dataType: 'json',
					data: post_data,
					error: function(){
						callback();
					},
					success: function(response){
						callback(response);
					}
				});
			}, 			
			onItemAdd: function(value, $item){
				var obj = this.options[value];
				if (selectCallback) {
					myFuncs[selectCallback]('onItemAdd', id, obj);
				}
			},
			onDelete : function(values) {
				var obj = this.options[values];
				if (selectCallback) {
					myFuncs[selectCallback]('onDelete', id, obj);
				}
			},
			onItemRemove : function(values) {
				var obj = this.options[values];
				if (selectCallback) {
					myFuncs[selectCallback]('onItemRemove', id, obj);
				}
			}
		};
		
		if( $('#'+id).attr('create') ) selectizeVariable.create = $('#'+id).attr('create');
		if( $('#'+id).attr('widthFields') ) selectizeVariable.width = $('#'+id).attr('widthFields');
		selectizeVariable.dropdownParent = selectDropdown;
		
		var searchField = $('#'+id).attr('searchField');
		selectizeVariable.searchField = searchField.split(",");
		
		// create render options
		var fields = {};
		showFields = $('#'+id).attr('showFields');
		classFields = $('#'+id).attr('classFields');
		if (showFields) {
			var arr_show = showFields.split(",");
			var arr_class = classFields.split(",");
			$.each(arr_show, function (i, f) {
				fields[f] = arr_class[i];
			});
		} else {
			fields[$('#'+id).attr('labelField')] = 'col-xs-12';
		}		
		selectizeVariable.render = {
			option: function(item, escape){						
				var ele = '';
				$.each(fields, function(k, cls) {
					if (k == 0) s = "";
					else s = "|&nbsp;&nbsp;";
					ele += '<div class="'+ cls +'" style="padding-left: 4px;">' +	
								'<p style="padding-bottom:1px !important;"><strong>'+ s + escape(item[k]) +'</strong></p>' + 
							'</div>';
				});
				return '<div id="render_'+id+'" class="col-lg-12" style="border-top :1px solid #ccc; padding: 0px !important">'+ ele +'</div>';
			},
		};			
		
		return $('#'+id).selectize(selectizeVariable); 
	}
	
	 // function(id, selectOptions, selectDropdown, selectCallback)
	var create_local_selectize = function(id, selectOptions, selectDropdown, selectCallback)  {
		
		maxItems = $('#'+id).attr('maxItems');
		if (!maxItems) maxItems = 1;
		
		var selectizeVariable = {
			maxItems: maxItems,
			placeholder: $('#'+id).attr('placeholder'),
			valueField: $('#'+id).attr('valueField'),
			labelField: $('#'+id).attr('labelField'),
			width: '50%',
			options: selectOptions,
			onItemAdd: function(value, $item){
				var obj = this.options[value];
				if (selectCallback) {
					myFuncs[selectCallback]('onItemAdd', id, obj);
				}
			},
			onDelete : function(values) {
				var obj = this.options[values];
				if (selectCallback) {
					myFuncs[selectCallback]('onDelete', id, obj);
				}
			},
			onItemRemove : function(values) {
				var obj = this.options[values];
				if (selectCallback) {
					myFuncs[selectCallback]('onItemRemove', id, obj);
				}
			}
		};
		
		if( $('#'+id).attr('create') ) selectizeVariable.create = $('#'+id).attr('create');
		if( $('#'+id).attr('widthFields') ) selectizeVariable.width = $('#'+id).attr('widthFields');
		selectizeVariable.dropdownParent = selectDropdown;
		
		var searchField = $('#'+id).attr('searchField');
		selectizeVariable.searchField = searchField.split(",");
		
		// create render options
		var fields = {};
		showFields = $('#'+id).attr('showFields');
		classFields = $('#'+id).attr('classFields');
		if (showFields) {
			var arr_show = showFields.split(",");
			var arr_class = classFields.split(",");
			$.each(arr_show, function (i, f) {
				fields[f] = arr_class[i];
			});
		} else {
			fields[$('#'+id).attr('labelField')] = 'col-xs-12';
		}		
		selectizeVariable.render = {
			option: function(item, escape){						
				var ele = '';
				$.each(fields, function(k, cls) {
					if (k == 0) s = "";
					else s = "|&nbsp;&nbsp;";
					ele += '<div class="'+ cls +'" style="padding-left: 4px;">' +	
								'<p style="padding-bottom:1px !important;"><strong>'+ s + escape(item[k]) +'</strong></p>' + 
							'</div>';
				});
				return '<div id="render_'+id+'" class="col-lg-12" style="border-top :1px solid #ccc; padding: 0px !important">'+ ele +'</div>';
			},
		};			
		
		return $('#'+id).selectize(selectizeVariable); 
	}
	/* 
	var create_ajax_selectize = function(id, selectCallback)  {
		var post_data = {
			or_like: {}
		};	
		
		maxItems = $('#'+id).attr('maxItems');
		if (!maxItems) maxItems = 1;
		
		var selectizeVariable = {
			maxItems: maxItems,
			placeholder: $('#'+id).attr('placeholder'),
			valueField: $('#'+id).attr('valueField'),
			labelField: $('#'+id).attr('labelField'),
			width: '50%',
			load: function(query, callback){
				this.clearOptions();
				this.clearCache();
				if (!query.length) return callback();
				
				// deklarasi fields yang digunakan untuk search
				var searchField = $('#'+id).attr('searchField');
				var arr_search = searchField.split(",");
				$.each(arr_search, function (i, obj) {
					post_data.or_like[obj] = query;
				});
						
				// deklarasi fields untuk filter data post
				var dataField = $('#'+id).attr('dataField');
				if (dataField) {
					var arr_data = dataField.split(",");
					$.each(arr_data, function (i, obj) {
						$('.'+obj).each(function() {
							post_data[$(this).attr('field')] = $(this).val();
						});
					});
				}
					
				// deklarasi fields untuk filter data post
				var dataNotIn = $('#'+id).attr('dataNotIn');
				if (dataNotIn) {
					var arr_data = dataNotIn.split(",");
					if ($('.'+arr_data[0]).length > 0) post_data['not_in'] = {};
					$.each(arr_data, function (i, obj) {
						post_data.not_in[obj] = {};
						$('.'+obj).each(function(i) {
							post_data.not_in[obj][i] = $(this).val();
						});
					});
				}
				
				// deklarasi fields yang digunakan untuk parent fields data pos
				var parentField = $('#'+id).attr('parentField');
				if (parentField) {
					var arr_parent = parentField.split(",");
					$.each(arr_parent, function (i, obj) {
						if($("#"+obj).val() == "") {
							set_alert('alert-danger', 'Warning:', 'Selectize dependency for field "'+$('#label-'+obj).text()+'" can not be empty. Fill the field first!');
							
							if ($('#'+arr_parent[0]).hasClass('selectized'))
								$('#'+arr_parent[0])[0].selectize.focus();
							else $('#'+arr_parent[0]).focus();								
							
							return false;
						}
						par = obj.replace("_update", "");
						post_data[par] = $("#"+obj).val();
					});
				}
						
				$.ajax({
					url: site_url+$('#'+id).attr('url'),
					type: 'POST',
					dataType: 'json',
					data: post_data,
					error: function(){
						callback();
					},
					success: function(response){
						callback(response);
					}
				});
			}, 			
			onItemAdd: function(value, $item){
				var obj = this.options[value];
				if (selectCallback) {
					myFuncs[selectCallback]('onItemAdd', id, obj);
				}
			},
			onDelete : function(values) {
				var obj = this.options[values];
				if (selectCallback) {
					myFuncs[selectCallback]('onDelete', id, obj);
				}
			},
			onItemRemove : function(values) {
				var obj = this.options[values];
				if (selectCallback) {
					myFuncs[selectCallback]('onItemRemove', id, obj);
				}
			}
		};
		
		if( $('#'+id).attr('create') ) selectizeVariable.create = $('#'+id).attr('create');
		// if( $('#'+id).attr('widthFields') ) selectizeVariable.width = $('#'+id).attr('widthFields');
		if( $('#'+id).attr('dropdownParent') ) selectizeVariable.dropdownParent = $('#'+id).attr('dropdownParent');
		
		var searchField = $('#'+id).attr('searchField');
		selectizeVariable.searchField = searchField.split(",");
		
		// create render options
		var fields = {};
		showFields = $('#'+id).attr('showFields');
		classFields = $('#'+id).attr('classFields');
		if (showFields) {
			var arr_show = showFields.split(",");
			var arr_class = classFields.split(",");
			$.each(arr_show, function (i, f) {
				fields[f] = arr_class[i];
			});
		} else {
			fields[$('#'+id).attr('labelField')] = 'col-xs-12';
		}
		selectizeVariable.render = {
			option: function(item, escape){						
				var ele = '';
				$.each(fields, function(k, cls) {
					ele += '<div class="'+ cls +'" style="padding-left: 4px;">' +	
								'<p style="padding-bottom:1px !important;"><strong>'+ escape(item[k]) +'</strong></p>' + 
							'</div>';
				});
				return '<div id="render_'+id+'" class="col-lg-12" style="border-top :1px solid #ccc; padding: 0px !important">'+ ele +'</div>';
			},
		};			
		
		return $('#'+id).selectize(selectizeVariable); 
	}
	 */
    
	return {
        submit_data: function (a, b) {
            submit(a, b);
        },
		show_alert: function(a, b, c) {// class, title, message			
			set_alert(a, b, c);
		},
        open_modal_edit: function(a, b) {
            modal_edit(a, b);
        },
        open_modal_delete: function(a) {
            modal_delete(a);
        },
        process_ajax: function(a, b, c) { //a: url, b: function callback, c: postdata
            do_ajax(a, b, c);
        },
		open_modal: function(url, title, message, post_data, header, btn) {
			var ele = $('<form />', { action: url, method: 'POST', id: 'form-modal' });
			if (!header) header = 'primary';
			if (post_data) {
				$.each(post_data, function (k, v) {
					ele.append($('<input />', { type: 'hidden', name: k, value: v }));
				});
			}
			if (!message) message = '<h4>Sabaaaarrrrr...</h4>';
			ele.append(message);
			
			$("#section_modal .modal-header").html(title);
			$("#section_modal .modal-header").addClass('modal-header-'+header);
			$("#section_modal #btn-modal-action").addClass('btn-'+header).html(btn);
			$("#section_modal").modal('show');
			$("#section_modal .modal-body").html(ele);
		},
		create_selectize: function(id, b, m, c) {
            // return do_selectize(ele, b, c);
			var post_data = {
				or_like: {}
			};			
			if(!m) m = 1;
			
			return $('#'+id).selectize({
				maxItems: m,
				placeholder: $('#'+id).attr('placeholder'),
				valueField: $('#'+id).attr('valueField'),
				labelField: $('#'+id).attr('labelField'), 
				searchField: $('#'+id).attr('searchField'),
				create: false,
				dropdownParent: 'body',
				render: {
					option: function(item, escape){	
						var ele_render = escape(item[$('#'+id).attr('labelField')]);
						if (c) {
							ele_render = myFuncs[c](item, escape);
						} else {
							ele_render = '<div class="col-xs-12" style="border-top :1px solid #ccc; padding: 0px !important">' +
											'<div class="col-xs-12" style="padding-left: 4px;">' +	
												'<p style="padding-bottom:1px !important;"><strong>' + escape(item[$('#'+id).attr('labelField')]) + '</strong></p>' +
											'</div>' +                       
										'</div>';
						}			
						return ele_render;	
					},
				},
				load: function(query, callback){
					this.clearOptions();
					this.clearCache();
					if (!query.length) return callback();
					
					// deklarasi fields yang digunakan untuk search
					var searchField = $('#'+id).attr('searchField');
					var arr_search = searchField.split(",");
					$.each(arr_search, function (i, obj) {
						post_data.or_like[obj] = query;
					});
							
					// deklarasi fields untuk filter data post
					var dataField = $('#'+id).attr('dataField');
					if (dataField) {
						var arr_data = dataField.split(",");
						$.each(arr_data, function (i, obj) {
							$('.'+obj).each(function() {
								post_data[$(this).attr('field')] = $(this).val();
							});
						});
					}
						
					// deklarasi fields untuk filter data post
					var dataNotIn = $('#'+id).attr('dataNotIn');
					if (dataNotIn) {
						var arr_data = dataNotIn.split(",");
						if ($('.'+arr_data[0]).length > 0) post_data['not_in'] = {};
						$.each(arr_data, function (i, obj) {
							post_data.not_in[obj] = {};
							$('.'+obj).each(function(i) {
								post_data.not_in[obj][i] = $(this).val();
							});
						});
					}
					
					// deklarasi fields yang digunakan untuk parent fields data pos
					var parentField = $('#'+id).attr('parentField');
					if (parentField) {
						var arr_parent = parentField.split(",");
						// var w = '';
						$.each(arr_parent, function (i, obj) {
							if($("#"+obj).val() == "") {
								// w = $('#label-'+obj).text()+" - "+ w;
								// var ele = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\
											// <span aria-hidden="true">&times;</span>\
										// </button>\
										// <strong>Warning: </strong>\
										// <span>Selectize dependency for field "'+$('#label-'+obj).text()+'" can not be empty. Fill the field first!</span>';			
								// $('#alert_section').html(ele);
								// fLayout.set_alert('warning');
								set_alert('alert-danger', 'Warning:', 'Selectize dependency for field "'+$('#label-'+obj).text()+'" can not be empty. Fill the field first!');
								
								if ($('#'+arr_parent[0]).hasClass('selectized'))
									$('#'+arr_parent[0])[0].selectize.focus();
								else $('#'+arr_parent[0]).focus();								
								
								return false;
							}
							par = obj.replace("_update", "");
							post_data[par] = $("#"+obj).val();
						});

					}
							
					$.ajax({
						url: site_url+$('#'+id).attr('url'),
						type: 'POST',
						dataType: 'json',
						data: post_data,
						error: function(){
							callback();
						},
						success: function(response){
							callback(response);
						}
					});
				}, 
				onItemAdd: function(value, $item){
					var obj = this.options[value];
					if (b) {
						myFuncs[b]('onItemAdd', id, obj);
					}
				},
				onDelete : function(values) {
					var obj = this.options[values];
					if (b) {
						myFuncs[b]('onDelete', id, obj);
					}
				},
				onItemRemove : function(values) {
					var obj = this.options[values];
					if (b) {
						myFuncs[b]('onItemRemove', id, obj);
					}
				}
			});
		},
		load_page: function(a, b) {
			$(a).load( b, function( xhr, status, error) { // response, status, xhr 
				if ( status == "error" ) {
					set_alert('alert-danger', 'Error '+ error.status +': ', error.statusText +'. Can not load for "'+ b + '", Contact your IT Support.');
					
					setTimeout( function(){ 
						$(document).find('#modal-loading').find('h3').text("It's load too long, call your IT Support.");
						setTimeout( function(){ 
							waitingDialog.hide();
						}, 3000);
					}, 10000);
				} else 
					waitingDialog.hide();
			});
		},
		submit_file: function (formData, urlData, b) {
			$.ajax({
				url: urlData,  //Server script to process data
				type: 'POST',
				data: formData,	// Form data		
				cache: false, //Options to tell jQuery not to process data or worry about content-type.
				contentType: false,
				processData: false,
				dataType: 'json',
				success: function(data) {
					if (data) {
						$('#alert_section').html(data[1]);
                        if (b) {
                            myFuncs[b](data);
							return;
                        }
						console.log(data);
						console.log(b);
                    }	
					waitingDialog.hide();
				},
				error: function(xhr, status, error) {
					var $response = $(xhr.responseText);				
					var dev_error_number = $response.find('p').eq(0).text();
					var dev_error_message = $response.find('p').eq(1).text();
						
					set_alert('alert-danger', dev_error_number, dev_error_message);
					waitingDialog.hide();
				},			
			});
		},
		create_selectize_modal: function(id, b, m, c) {
            // return do_selectize(ele, b, c);
			var post_data = {
				or_like: {}
			};			
			if(!m) m = 1;
			
			return $('#'+id).selectize({
				maxItems: m,
				placeholder: $('#'+id).attr('placeholder'),
				valueField: $('#'+id).attr('valueField'),
				labelField: $('#'+id).attr('labelField'), 
				searchField: $('#'+id).attr('searchField'),
				create: false,
				render: {
					option: function(item, escape){	
						var ele_render = escape(item[$('#'+id).attr('labelField')]);
						if (c) {
							ele_render = myFuncs[c](item, escape);
						} else {
							ele_render = '<div class="col-xs-12" style="border-top :1px solid #ccc; padding: 0px !important">' +
											'<div class="col-xs-12" style="padding-left: 4px;">' +	
												'<p style="padding-bottom:1px !important;"><strong>' + escape(item[$('#'+id).attr('labelField')]) + '</strong></p>' +
											'</div>' +                       
										'</div>';
						}			
						return ele_render;	
					},
				},
				load: function(query, callback){
					this.clearOptions();
					this.clearCache();
					if (!query.length) return callback();
					
					// deklarasi fields yang digunakan untuk search
					var searchField = $('#'+id).attr('searchField');
					var arr_search = searchField.split(",");
					$.each(arr_search, function (i, obj) {
						post_data.or_like[obj] = query;
					});
							
					// deklarasi fields untuk filter data post
					var dataField = $('#'+id).attr('dataField');
					if (dataField) {
						var arr_data = dataField.split(",");
						$.each(arr_data, function (i, obj) {
							$('.'+obj).each(function() {
								post_data[$(this).attr('field')] = $(this).val();
							});
						});
					}
					
					// deklarasi fields yang digunakan untuk parent fields data pos
					var parentField = $('#'+id).attr('parentField');
					if (parentField) {
						var arr_parent = parentField.split(",");
						// var w = '';
						$.each(arr_parent, function (i, obj) {
							if($("#"+obj).val() == "") {
								// w = $('#label-'+obj).text()+" - "+ w;
								// var ele = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\
											// <span aria-hidden="true">&times;</span>\
										// </button>\
										// <strong>Warning: </strong>\
										// <span>Selectize dependency for field "'+$('#label-'+obj).text()+'" can not be empty. Fill the field first!</span>';			
								// $('#alert_section').html(ele);
								// fLayout.set_alert('warning');
								set_alert('alert-danger', 'Warning:', 'Selectize dependency for field "'+$('#label-'+obj).text()+'" can not be empty. Fill the field first!');
								
								if ($('#'+arr_parent[0]).hasClass('selectized'))
									$('#'+arr_parent[0])[0].selectize.focus();
								else $('#'+arr_parent[0]).focus();								
								
								return false;
							}
							par = obj.replace("_update", "");
							post_data[par] = $("#"+obj).val();
						});

					}
							
					$.ajax({
						url: site_url+$('#'+id).attr('url'),
						type: 'POST',
						dataType: 'json',
						data: post_data,
						error: function(){
							callback();
						},
						success: function(response){
							callback(response);
						}
					});
				}, 
				onItemAdd: function(value, $item){
					var obj = this.options[value];
					if (b) {
						myFuncs[b]('onItemAdd', id, obj);
					}
				},
				onDelete : function(values) {
					var obj = this.options[values];
					if (b) {
						myFuncs[b]('onDelete', id, obj);
					}
				},
				onItemRemove : function(values) {
					var obj = this.options[values];
					if (b) {
						myFuncs[b]('onItemRemove', id, obj);
					}
				}
			});
		},
		static_selectize: function (a, b, c, d, e, f) { // function(id, selectOptions, selectDropdown, selectCallback, selectCreate, m)
			return create_static_selectize(a, b, c, d, e, f);
		},
		ajax_selectize: function (a, b, c) { // function(id, selectDropdown, selectCallback)
			return create_ajax_selectize(a, b, c);
		},		
		local_selectize: function (a, b, c, d) { // function(id, selectOptions, selectDropdown, selectCallback)
			return create_local_selectize(a, b, c, d);
		}
	};
    
}();

// Function For Number Format 
Number.prototype.format = function(n, x, s, c) {
	var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
		num = this.toFixed(Math.max(0, ~~n));

	return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
	
	// console.log(12345678.9.format(0, 3, '-')); //12-345-679
	// console.log(12345678.9.format(2, 3, '.', ',')); //12.345.678,90
	// console.log(123456.789.format(4, 4, ' ', ':')); //12 3456:7890
};

String.prototype.tonumber = function() {
	str = this.replaceAll('.', '');
	return parseFloat(str.replaceAll(',', '.'));
}

String.prototype.replaceAll = function(search, replace){
	//if replace is not sent, return original string otherwise it will
	//replace search string with 'undefined'.
	if (replace === undefined) {
		return this.toString();
	}
	return this.replace(new RegExp('[' + search + ']', 'g'), replace);
};
