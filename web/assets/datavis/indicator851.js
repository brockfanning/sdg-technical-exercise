d3.json('/data.json.php', function(data) {

  var margin = { top: 40, right: 40, bottom: 40, left: 40 };
  var width = 980 - margin.left - margin.right;
  var height = 500 - margin.top - margin.bottom;


  var lowestWageValues = data.map(function(points) {
    var lowest = 9999;
    for (var point in points) {
      var val = points[point].value;
      if (val < lowest) {
        lowest = val;
      }
    }
    return lowest;
  });

  var highestWageValues = data.map(function(points) {
    var highest = 0;
    for (var point in points) {
      var val = points[point].value;
      if (val > highest) {
        highest = val;
      }
    }
    return highest;
  });

  var numPoints = data[0].length;

  var firstYear = new Date(+data[0][0].year, 0, 0);
  var lastYear = new Date(+data[0][numPoints - 1].year, 0, 0);

  var xScale = d3.scaleTime()
    .domain([firstYear, lastYear])
    .range([0, width]);

  var yScale = d3.scaleLinear()
    .domain([d3.max(highestWageValues), d3.min(lowestWageValues)])
    .range([0, height]);

  var line = d3.line()
    .x(function(d) { return xScale(new Date(+d.year, 0, 0)); })
    .y(function(d) { return yScale(d.value); });

  var svg = d3.select('.line-chart').append('svg')
      .attr('width', width + margin.left + margin.right)
      .attr('height', height + margin.top + margin.bottom)
    .append('g')
      .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

  svg.append('g')
      .attr('class', 'x axis')
      .attr('transform', 'translate(0,' + height + ')')
      .call(d3.axisBottom(xScale));

  svg.append('g')
      .attr('class', 'y axis')
      .call(d3.axisLeft(yScale));

  for (var i in data) {
    svg.append('path')
        .datum(data[i])
        .attr('class', function(d) { return 'line ' + d[0].metric; })
        .attr('d', line);
  }
});