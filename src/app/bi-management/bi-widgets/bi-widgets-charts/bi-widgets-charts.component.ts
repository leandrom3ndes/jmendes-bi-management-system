import { Component, OnInit } from '@angular/core';
import { EChartOption } from 'echarts';

@Component({
  selector: 'app-bi-widgets-charts',
  templateUrl: './bi-widgets-charts.component.html',
  styleUrls: ['./bi-widgets-charts.component.css']
})
export class BiWidgetsChartsComponent implements OnInit {

    options: any;
    constructor() { }
    chartOption: EChartOption = {
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            type: 'value'
        },
        tooltip: {
            trigger: 'item',
            showDelay: 0,
            transitionDuration: 0.2,
            formatter: function (params) {
                return `<b>${params['name']}</b> : $ ${params['value']}`;
            }
        },
        series: [{
            data: [820, 932, 901, 934, 1290, 1430, 1550, 1200, 1650.1450, 1680, 1890, 2300],
            type: 'line',
            areaStyle: {}
        }]
    };

    ngOnInit(): void {
        const xAxisData = [];
        const data1 = [];
        const data2 = [];

        for (let i = 0; i < 100; i++) {
            xAxisData.push('category' + i);
            data1.push((Math.sin(i / 5) * (i / 5 - 10) + i / 6) * 5);
            data2.push((Math.cos(i / 5) * (i / 5 - 10) + i / 6) * 5);
        }

        this.options = {
            legend: {
                data: ['bar', 'bar2'],
                align: 'left',
            },
            tooltip: {},
            xAxis: {
                data: xAxisData,
                silent: false,
                splitLine: {
                    show: false,
                },
            },
            yAxis: {},
            series: [
                {
                    name: 'bar',
                    type: 'bar',
                    data: data1,
                    animationDelay: (idx) => idx * 10,
                },
                {
                    name: 'bar2',
                    type: 'bar',
                    data: data2,
                    animationDelay: (idx) => idx * 10 + 100,
                },
            ],
            animationEasing: 'elasticOut',
            animationDelayUpdate: (idx) => idx * 5,
        };
    }

}
