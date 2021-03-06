<?php
/**
 * @var \phpOMS\Views\View $this
 */

/*
* UI Logic
*/
$watchList  = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$headerView = new \Web\Views\Lists\HeaderView($this->app, $this->request, $this->response);

$watchList->setTemplate('/Web/Templates/Lists/ListFull');
$headerView->setTemplate('/Web/Templates/Lists/Header/HeaderTable');

/*
 * Header
 */
$headerView->setTitle($this->l11n->lang['RiskManagement']['Watchlist']);
$headerView->setHeader([
    ['title' => $this->l11n->lang[0]['ID'], 'sortable' => true],
    ['title' => $this->l11n->lang['RiskManagement']['Name'], 'sortable' => true, 'full' => true],
    ['title' => $this->l11n->lang['RiskManagement']['Parent'], 'sortable' => true],
    ['title' => $this->l11n->lang['RiskManagement']['Severity'], 'sortable' => true],
    ['title' => $this->l11n->lang['RiskManagement']['Probability'], 'sortable' => true],
    ['title' => $this->l11n->lang['RiskManagement']['Department'], 'sortable' => true],
    ['title' => $this->l11n->lang['RiskManagement']['Category'], 'sortable' => true],
    ['title' => $this->l11n->lang['RiskManagement']['Due'], 'sortable' => true],
]);

$watchList->addView('header', $headerView);

/*
 * Statistics
 */
$panelStatView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelStatView->setTemplate('/Web/Templates/Panel/BoxFull');
$panelStatView->setTitle($this->l11n->lang['RiskManagement']['Statistics']);
$this->addView('stats', $panelStatView);

$statTableView = new \Web\Views\Lists\ListView($this->app, $this->request, $this->response);
$statTableView->setTemplate('/Web/Templates/Lists/AssocList');
$statTableView->setElements([
    [$this->l11n->lang['RiskManagement']['RiskIndex'], 0],
    [$this->l11n->lang['RiskManagement']['OverallRisk'], 0],
    [$this->l11n->lang['RiskManagement']['RiskProtection'], 0],
    [$this->l11n->lang['RiskManagement']['RemainingRisk'], 0],
    [$this->l11n->lang['RiskManagement']['RiskAcceptance'], 0],
    [$this->l11n->lang['RiskManagement']['Risks'], 0],
    [$this->l11n->lang['RiskManagement']['Causes'], 0],
    [$this->l11n->lang['RiskManagement']['Solutions'], 0],
    [$this->l11n->lang['RiskManagement']['Processes'], 0],
    [$this->l11n->lang['RiskManagement']['Projects'], 0],
    [$this->l11n->lang['RiskManagement']['Outdated'], 0],
    [$this->l11n->lang['RiskManagement']['Critical'], 0],
    [$this->l11n->lang['RiskManagement']['MainDepartment'], 0],
    [$this->l11n->lang['RiskManagement']['MainCategory'], 0],
    [$this->l11n->lang['RiskManagement']['MainCause'], 0],
]);

$this->getView('stats')->addView('stat::table', $statTableView);

$panelExportView = new \Web\Views\Panel\PanelView($this->app, $this->request, $this->response);
$panelExportView->setTemplate('/Web/Templates/Panel/BoxFull');
$panelExportView->setTitle($this->l11n->lang['RiskManagement']['Export']);

$formExportView = new \Web\Views\Form\FormView($this->app, $this->request, $this->response);
$formExportView->setTemplate('/Web/Templates/Forms/FormFull');
$formExportView->setSubmit('submit1', $this->l11n->lang['RiskManagement']['Export']);
$formExportView->setAction($this->request->getUri()->getScheme() . '://' . $this->request->getUri()->getHost());
$formExportView->setMethod(\phpOMS\Message\RequestMethod::POST);

// TODO: put this on all risk management pages except settings - export should also export historic values (csv, excel)
$formExportView->setElement(0, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        ['value' => 0, 'content' => 'English', 'selected' => true],
    ],
    'label'   => $this->l11n->lang['RiskManagement']['Language'],
    'name'    => 'language',
]);

$formExportView->setElement(1, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        ['value' => 'CockpitBasic', 'content' => $this->l11n->lang['RiskManagement']['Basic'], 'selected' => true],
    ],
    'label'   => $this->l11n->lang['RiskManagement']['Theme'],
    'name'    => 'language',
]);

$formExportView->setElement(2, 0, [
    'type'    => \phpOMS\Html\TagType::SELECT,
    'options' => [
        ['value' => 0, 'content' => 'PDF', 'selected' => true],
    ],
    'label'   => $this->l11n->lang['RiskManagement']['Type'],
    'name'    => 'export',
]);

$panelExportView->addView('form', $formExportView);
$this->addView('export', $panelExportView);

/*
 * Navigation
 */
$nav = new \Modules\Navigation\Views\NavigationView($this->app, $this->request, $this->response);
$nav->setTemplate('/Modules/Navigation/Theme/Backend/mid');
$nav->setNav($this->getData('nav'));
$nav->setLanguage($this->l11n->language);
$nav->setParent(1003001001);
?>
<?= $nav->render(); ?>

<div class="b-7" id="i3-2-1">
    <div class="b b-5 c3-2 c3" id="i3-2-5">
        <div class="bc-1">
            <ul class="l-1">
                <li><?= $this->l11n->lang['RiskManagement']['Unit']; ?>
                <li><select>
                        <option value="0" selected><?= $this->l11n->lang['RiskManagement']['All']; ?>
                    </select>
            </ul>
        </div>
    </div>

    <?= $panelExportView->render(); ?>

    <?= $panelStatView->render(); ?>
</div>
<div class="b-6">
    <?= $watchList->render(); ?>

    <div class="b b-2 c30-1 c30" id="i30-1-1">
        <h1>
            <?= $this->l11n->lang['RiskManagement']['TopRisks']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <div class="chart" id="chart-1">
                <style type="text/css" scoped>

                    .bar {
                        fill: steelblue;
                    }

                    .bar:hover {
                        fill: brown;
                    }

                    .axis {
                        font: 10px sans-serif;
                    }

                    .axis path,
                    .axis line {
                        fill: none;
                        stroke: #000;
                        shape-rendering: crispEdges;
                    }

                </style>
                <script>
                    function type(d) {
                        d.frequency = +d.frequency;
                        return d;
                    }
                    function resize_chart1(data, chart) {
                        d3.select('#' + chart + " svg").remove();

                        var margin = {top: 10, right: 10, bottom: 20, left: 20},
                            width = parseFloat(jsOMS.getPropertyValue(document.getElementById(chart), 'width'), 10) - margin.left - margin.right,
                            height = 300 - margin.top - margin.bottom,
                            percent = d3.format('%');

                        var x = d3.scale.ordinal()
                            .rangeRoundBands([0, width], .1);

                        var y = d3.scale.linear()
                            .range([height, 0]);

                        var xAxis = d3.svg.axis()
                            .scale(x)
                            .orient("bottom");

                        var yAxis = d3.svg.axis()
                            .scale(y)
                            .orient("left")
                            .ticks(10, "");

                        var svg = d3.select('#' + chart).append("svg")
                            .attr("width", width + margin.left + margin.right)
                            .attr("height", height + margin.top + margin.bottom)
                            .append("g")
                            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                        x.domain(data.map(function (d) {
                            return d.letter;
                        }));
                        y.domain([0, d3.max(data, function (d) {
                            return d.frequency;
                        })]);

                        svg.append("g")
                            .attr("class", "x axis")
                            .attr("transform", "translate(0," + height + ")")
                            .call(xAxis);

                        svg.append("g")
                            .attr("class", "y axis")
                            .call(yAxis)
                            .append("text")
                            .attr("transform", "rotate(-90)")
                            .attr("y", 6)
                            .attr("dy", ".71em")
                            .style("text-anchor", "end")
                            .text("Risk");

                        svg.selectAll(".bar")
                            .data(data)
                            .enter().append("rect")
                            .attr("class", "bar")
                            .attr("x", function (d) {
                                return x(d.letter);
                            })
                            .attr("width", x.rangeBand())
                            .attr("y", function (d) {
                                return y(d.frequency);
                            })
                            .attr("height", function (d) {
                                return height - y(d.frequency);
                            });
                    }

                    jsOMS.ready(function () {
                        d3.csv(URL + "/Modules/RiskManagement/data/cockpit/top.csv", type, function (error, data) {
                            jsOMS.listenEvent(window, 'resize', function () {
                                resize_chart1(data, "chart-1");
                            });
                            resize_chart1(data, "chart-1");
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="b b-2 c30-1 c30" id="i30-1-3">
        <h1>
            <?= $this->l11n->lang['RiskManagement']['History']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <div class="chart" id="chart-2">
                <style type="text/css" scoped>
                    .rule {
                        fill: none;
                        stroke: #cacaca;
                        stroke-width: 1px;
                    }

                    .area {
                        fill: steelblue;
                    }
                </style>
                <script>
                    function resize_chart2(data, chart) {
                        d3.select('#' + chart + " svg").remove();

                        var margin = {top: 10, right: 10, bottom: 20, left: 30},
                            width = parseFloat(jsOMS.getPropertyValue(document.getElementById(chart), 'width'), 10) - margin.left - margin.right,
                            height = 300 - margin.top - margin.bottom;

                        var x = d3.time.scale()
                            .range([0, width]);

                        var y = d3.scale.linear()
                            .range([height, 0]);

                        var xAxis = d3.svg.axis()
                            .scale(x)
                            .orient("bottom");

                        var yAxis = d3.svg.axis()
                            .scale(y)
                            .orient("left");

                        var line = d3.svg.line()
                            .x(function (d) {
                                return x(d.date);
                            })
                            .y(function (d) {
                                return y(d.close);
                            });

                        var area = d3.svg.area()
                            .x(function (d) {
                                return x(d.date);
                            })
                            .y0(height)
                            .y1(function (d) {
                                return y(d.close);
                            });

                        var svg = d3.select('#' + chart).append("svg")
                            .attr("width", width + margin.left + margin.right)
                            .attr("height", height + margin.top + margin.bottom)
                            .append("g")
                            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                        x.domain(d3.extent(data, function (d) {
                            return d.date;
                        }));
                        y.domain([0, d3.max(data, function (d) {
                            return d.close;
                        })]);

                        var maxVal = d3.max(data, function (d) {
                            return d.close;
                        });
                        var minVal = 0;

                        var rule1 = [
                            {'x': 1, 'y': y(maxVal / 3 + minVal)},
                            {'x': width, 'y': y(maxVal / 3 + minVal)}
                        ];
                        var rule2 = [
                            {'x': 1, 'y': y(2 * maxVal / 3 + minVal)},
                            {'x': width, 'y': y(2 * maxVal / 3 + minVal)}
                        ];

                        var lineFunction = d3.svg.line()
                            .x(function (d) {
                                return d.x;
                            })
                            .y(function (d) {
                                return d.y;
                            })
                            .interpolate("linear");
                        svg.append("path")
                            .datum(data)
                            .attr("class", "area")
                            .attr("d", area);

                        svg.append("path")
                            .attr('class', 'rule')
                            .attr('d', lineFunction(rule1));

                        svg.append("path")
                            .attr('class', 'rule')
                            .attr('d', lineFunction(rule2));

                        svg.append("g")
                            .attr("class", "x axis")
                            .attr("transform", "translate(0," + height + ")")
                            .call(xAxis)
                            .append("text")
                            .attr("x", width - margin.right)
                            .attr("dx", ".71em")
                            .attr("y", -6)
                            .style("text-anchor", "end")
                            .text("Date");

                        svg.append("g")
                            .attr("class", "y axis")
                            .call(yAxis)
                            .append("text")
                            .attr("transform", "rotate(-90)")
                            .attr("y", 6)
                            .attr("dy", ".71em")
                            .style("text-anchor", "end")
                            .text("Price ($)");
                    }

                    jsOMS.ready(function () {
                        var parseDate = d3.time.format("%d-%b-%y").parse;

                        d3.csv(URL + "/Modules/RiskManagement/data/cockpit/history.csv", function (error, data) {
                            data.forEach(function (d) {
                                d.date = parseDate(d.date);
                                d.close = +d.close;
                            });

                            jsOMS.listenEvent(window, 'resize', function () {
                                resize_chart2(data, "chart-2");
                            });
                            resize_chart2(data, "chart-2");
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="b b-2 c30-1 c30" id="i30-1-6">
        <h1>
            <?= $this->l11n->lang['RiskManagement']['Departments']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <div class="chart" id="chart-3">
                <style type="text/css" scoped>
                    .rule {
                        fill: none;
                        stroke: #cacaca;
                        stroke-width: 1px;
                    }

                    .area {
                        fill: steelblue;
                    }
                </style>
                <script>
                    function resize_chart3(data, chart) {
                        d3.select('#' + chart + " svg").remove();

                        var margin = {top: 10, right: 10, bottom: 20, left: 30},
                            width = parseFloat(jsOMS.getPropertyValue(document.getElementById(chart), 'width'), 10) - margin.left - margin.right,
                            height = 300 - margin.top - margin.bottom,
                            radius = Math.min(width, height) / 2;

                        var color = d3.scale.ordinal()
                            .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

                        var arc = d3.svg.arc()
                            .outerRadius(radius - 10)
                            .innerRadius(0);

                        var pie = d3.layout.pie()
                            .sort(null)
                            .value(function (d) {
                                return d.population;
                            });

                        var svg = d3.select('#' + chart).append("svg")
                            .attr("width", width)
                            .attr("height", height)
                            .append("g")
                            .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

                        var g = svg.selectAll(".arc")
                            .data(pie(data))
                            .enter().append("g")
                            .attr("class", "arc");

                        g.append("path")
                            .attr("d", arc)
                            .style("fill", function (d) {
                                return color(d.data.age);
                            });

                        g.append("text")
                            .attr("transform", function (d) {
                                return "translate(" + arc.centroid(d) + ")";
                            })
                            .attr("dy", ".35em")
                            .style("text-anchor", "middle")
                            .text(function (d) {
                                return d.data.age;
                            });
                    }

                    jsOMS.ready(function () {
                        d3.csv(URL + "/Modules/RiskManagement/data/cockpit/departments.csv", function (error, data) {
                            data.forEach(function (d) {
                                d.population = +d.population;
                            });

                            jsOMS.listenEvent(window, 'resize', function () {
                                resize_chart3(data, "chart-3");
                            });
                            resize_chart3(data, "chart-3");
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="b b-2 c30-1 c30" id="i30-1-6">
        <h1>
            <?= $this->l11n->lang['RiskManagement']['Categories']; ?>
            <i class="fa fa-minus min"></i>
            <i class="fa fa-plus max vh"></i>
        </h1>

        <div class="bc-1">
            <div class="chart" id="chart-4">
                <style type="text/css" scoped>
                    .rule {
                        fill: none;
                        stroke: #cacaca;
                        stroke-width: 1px;
                    }

                    .area {
                        fill: steelblue;
                    }
                </style>
                <script>
                    function resize_chart4(data, chart) {
                        d3.select('#' + chart + " svg").remove();

                        var margin = {top: 10, right: 10, bottom: 20, left: 30},
                            width = parseFloat(jsOMS.getPropertyValue(document.getElementById(chart), 'width'), 10) - margin.left - margin.right,
                            height = 300 - margin.top - margin.bottom,
                            radius = Math.min(width, height) / 2;

                        var color = d3.scale.ordinal()
                            .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

                        var arc = d3.svg.arc()
                            .outerRadius(radius - 10)
                            .innerRadius(0);

                        var pie = d3.layout.pie()
                            .sort(null)
                            .value(function (d) {
                                return d.population;
                            });

                        var svg = d3.select('#' + chart).append("svg")
                            .attr("width", width)
                            .attr("height", height)
                            .append("g")
                            .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

                        var g = svg.selectAll(".arc")
                            .data(pie(data))
                            .enter().append("g")
                            .attr("class", "arc");

                        g.append("path")
                            .attr("d", arc)
                            .style("fill", function (d) {
                                return color(d.data.age);
                            });

                        g.append("text")
                            .attr("transform", function (d) {
                                return "translate(" + arc.centroid(d) + ")";
                            })
                            .attr("dy", ".35em")
                            .style("text-anchor", "middle")
                            .text(function (d) {
                                return d.data.age;
                            });
                    }

                    jsOMS.ready(function () {
                        d3.csv(URL + "/Modules/RiskManagement/data/cockpit/departments.csv", function (error, data) {
                            data.forEach(function (d) {
                                d.population = +d.population;
                            });

                            jsOMS.listenEvent(window, 'resize', function () {
                                resize_chart4(data, "chart-4");
                            });
                            resize_chart4(data, "chart-4");
                        });
                    });
                </script>
            </div>
        </div>
    </div>

</div>