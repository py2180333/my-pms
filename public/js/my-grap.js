// circle chart
var chart = AmCharts.makeChart("circlechart", {
    "type": "pie",
    "theme": "light",
    "dataProvider": [{
        "country": "Lithuania",
        "value": 260
    }, {
        "country": "Ireland",
        "value": 201
    }, {
        "country": "Germany",
        "value": 65
    }, {
        "country": "Australia",
        "value": 39
    }, {
        "country": "UK",
        "value": 19
    }, {
        "country": "Latvia",
        "value": 10
    }],
    "valueField": "value",
    "titleField": "country",
    "outlineAlpha": 0.4,
    "depth3D": 15,
    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
    "angle": 30,
    "export": {
        "enabled": true
    }
});
// jQuery('.chart-input').off().on('input change', function () {
// 	var property = jQuery(this).data('property');
// 	var target = chart;
// 	var value = Number(this.value);
// 	chart.startDuration = 0;

// 	if (property == 'innerRadius') {
// 		value += "%";
// 	}

// 	target[property] = value;
// 	chart.validateNow();
// });
// circle chat end





// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("secondgrap", am4charts.XYChart3D);

// Add data
chart.data = [{
  "year": 2005,
  "income": 23.5,
  "color": chart.colors.next()
}, {
  "year": 2006,
  "income": 26.2,
  "color": chart.colors.next()
}, {
  "year": 2007,
  "income": 30.1,
  "color": chart.colors.next()
}, {
  "year": 2008,
  "income": 29.5,
  "color": chart.colors.next()
}, {
  "year": 2009,
  "income": 24.6,
  "color": chart.colors.next()
}];

// Set chart colors
chart.colors.list = [
  am4core.color("#7fb800"),
  am4core.color("#FF9800"),
  am4core.color("#f44336")
];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.numberFormatter.numberFormat = "#";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Income";

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "income";
series.dataFields.categoryX = "year";
series.name = "Income";
series.columns.template.propertyFields.fill = "color";
series.columns.template.tooltipText = "{valueY}";
series.columns.template.column3D.stroke = am4core.color("#fff");
series.columns.template.column3D.strokeOpacity = 0.2;
series.columns.template.adapter.add("fill", function (fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});













$(document).ready(function() {
    $(".toggle-arrow").click(function() {
        $(this).toggleClass("is-active");
    });
});




// tag
// input tag name
var inputArea = $(".inputtag"),
  tagArea = $(".tags"),
  msg = "Please Add Some of your Skills!",
  tag, data, close, count;

$(inputArea).on("change", function() {
  data = $(this).val();

  tag = $("<span class='tag'>" + data + "</span>").appendTo(tagArea);
  close = $("<span class='fa fa-close'></span>").appendTo(tag);
  $(this).val("");

  close.on("click", function() {
    $(this).parent().remove();
  });
}); 
// input tag name end
 $(document).ready(function() {
  $('#projectdetails').submit(function(event) {
    // Prevent the form from submitting and refreshing the page
    event.preventDefault();
    
    // Optionally, you can handle form data submission via AJAX here
    // Example AJAX submission:
    // var formData = $(this).serialize();
    // $.post('submit.php', formData, function(response) {
    //   // Handle response from server if needed
    // });
  });
});



        // img uplode
        function displaySelectedImage(event, elementId) {
          const selectedImage = document.getElementById(elementId);
          const fileInput = event.target;
      
          if (fileInput.files && fileInput.files[0]) {
              const reader = new FileReader();
      
              reader.onload = function(e) {
                  selectedImage.src = e.target.result;
              };
      
              reader.readAsDataURL(fileInput.files[0]);
          }
      }

      // search and seclect
      $(document).ready(function() {
        // Initialize Select2 on the dropdown with full width
        $('.role_position').select2({
            placeholder: "",
            allowClear: true,
            width: '100%'  // Set width to 100%
        });
    });





