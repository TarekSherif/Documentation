@extends('layouts.index')

@section('CoreContent')
<div id = "container" style = "width: 550px; height: 400px; margin: 0 auto"></div>
   

    
@endsection



@section('ScriptContent')
<script src="{{url('/')}}/js/highcharts.js"></script>
<script language = "JavaScript">
        $(document).ready(function() {
            console.log(@json($Branches));
            
           var chart = {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false
           };
           var title = {
              text: ''   
           };      
           var tooltip = {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
           };
           var plotOptions = {
              pie: {
                 allowPointSelect: true,
                 cursor: 'pointer',
                 
                 dataLabels: {
                    enabled: false           
                 },
                 
                 showInLegend: true
              }
           };
           var series = [{
              type: 'pie',
              name: 'Browser share',
              data: [
              
                
                @foreach ($Branches as $Branch)
                    ['{{$Branch->BName}}',{{$Branch->price/$Total}}],
                @endforeach

              ]
           }];     
           var json = {};   
           json.chart = chart; 
           json.title = title;     
           json.tooltip = tooltip;  
           json.series = series;
           json.plotOptions = plotOptions;
           $('#container').highcharts(json);  
        });
     </script>
@endsection