$(document).ready(function() {
    $('.select2').select2({
      tags: true,
      tokenSeparators: [',']
    }).on('change', function(e){
      let label = $(this).find("[data-select2-tag=true]");
      if(label.length && $.inArray(label.val(), $(this).val() !== -1)){
        $.ajax({
          url: "/tags/ajout/ajax/"+label.val(),
          type: "POST"
        }).done(function(data){
          label.replaceWith(`<option selected value="${data.id}">${label.val()}</option>`)
        })
      }
    });
   });

