import { jsOMS }      from '../../../jsOMS/Utils/oLib.js';
import { Autoloader } from '../../../jsOMS/Autoloader.js';

Autoloader.defineNamespace('omsApp.Modules');

/* global omsApp */
omsApp.Modules.RiskManagement = class {
    /**
     * @constructor
     *
     * @since 1.0.0
     */
    constructor  (app)
    {
        this.app = app;
    };

    bind (id)
    {
        const charts = typeof id === 'undefined' ? document.getElementsByTagName('canvas') : [document.getElementById(id)];
        let length   = charts.length;

        for (let i = 0; i < length; ++i) {
            if (charts[i].getAttribute('data-chart') === null
                && charts[i].getAttribute('data-chart') !== 'undefined'
            ) {
                continue;
            }

            this.bindChart(charts[i]);
        }

        const maps = typeof id === 'undefined' ? document.getElementsByClassName('map') : [document.getElementById(id)];
        length     = maps.length;

        for (let i = 0; i < length; ++i) {
            this.bindMap(maps[i]);
        }
    };

    bindChart (chart)
    {
        if (typeof chart === 'undefined' || !chart) {
            jsOMS.Log.Logger.instance.error('Invalid chart: ' + chart, 'RiskManagement');

            return;
        }

        const data = JSON.parse(chart.getAttribute('data-chart'));

        if (data.type === 'scatter') {
            const gradientPlugin = {
                id: 'gradientPlugin',
                beforeDraw: function (chart, args, options) {
                    const { ctx } = chart;
                    const canvas = chart.canvas;
                    const chartArea = chart.chartArea;

                    // Chart background
                    const gradientBack = canvas.getContext('2d').createLinearGradient(0,
                        canvas.height,
                        canvas.width, 0
                    );

                    gradientBack.addColorStop(0.2, 'rgba(0, 255, 0, 0.5)');
                    gradientBack.addColorStop(0.55, 'rgba(255, 255, 0, 0.5)');
                    gradientBack.addColorStop(0.8, 'rgba(255, 0, 0, 0.5)');

                    ctx.fillStyle = gradientBack;
                    ctx.fillRect(
                        chartArea.left,
                        chartArea.bottom,
                        chartArea.right - chartArea.left,
                        chartArea.top - chartArea.bottom
                    );
                }
            };

            data.plugins = [gradientPlugin];
        }

        /* global Chart */
        // eslint-disable-next-line no-unused-vars
        const myChart = new Chart(chart.getContext('2d'), data);
    };
};

window.omsApp.moduleManager.get('RiskManagement').bind();
