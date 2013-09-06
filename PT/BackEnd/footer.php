<script>
$('#content').corner("right");
$('#links').corner("left");
$('.linkhdr').corner("right");


$('#wrapper').corner();

$("#mainLinks > li > div").click(function(){

$(this).next().slideToggle(300);
});

$('#mainLinks ul:eq(0)').show();
$('#mainLinks ul:eq(1)').show();
$('#mainLinks ul:eq(2)').show();	
$('#mainLinks ul:eq(3)').show();	

$('#useHdrTextYes').change(function() {
   if($('#useHdrTextYes').is(':checked'))
   {
       $('#hdrTxt').show();
	   $('#submitted').hide();

   }
});
$('#useHdrTextNo').change(function() {
	if($('#useHdrTextNo').is(':checked'))
   {
       $('#hdrTxt').hide();
	   $('#submitted').show();
   }
});

$('#useBgrImage').change(function() {
   if($('#useBgrImage').is(':checked'))
   {
       $('#bgbutton').show();
   }
});
$('#useBgrSolid').change(function() {
	if($('#useBgrSolid').is(':checked'))
   {
       $('#bgbutton').hide();
   }
});
</script>

</body>
</html>