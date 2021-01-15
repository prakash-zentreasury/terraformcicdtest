
import Chart from 'chart.js';

export default{

    props: {
        url: ''
       },
    template:  '<div id="wrapper1" style="position: relative; height: 22vh"><canvas id="pie"></canvas><div id="chart-legends2"></div></div>',

    mounted() {
        this.load();


    },

    methods: {

        load() {
            this.fetchData().then(response =>
            {
                //console.log(response.data);
                //      console.log(response.data['labels'][0]); // Dumps object including
                const labels = response.data['labels'];
            const datasetValue = response.data['data'];
/*            console.log(labels);
            console.log(datasetValue);*/


            const data = {
                datasets: [{
                    backgroundColor: [
                        "#81c7ef",
                        "#358bc4",
                        "#0e547c"
                    ],
                    data: datasetValue
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: labels
            };

            console.log(data.datasets[0].data);
            console.log(data.datasets[0].backgroundColor);
            console.log(data.labels);
            if (typeof this.myChart !== "undefined") {

                this.myChart.data.labels = data.labels;
                this.myChart.data.datasets = data.datasets;
                this.myChart.update();
            } else {
                var context = document.getElementById('pie').getContext('2d');
                document.getElementById("wrapper1").style.height = '22vh';
                this.myChart = new Chart(context,
                    {

                        type: 'pie',
                        data: data,
                        options: {
                            plugins: {
                                datalabels: {
                                    display: false,
                                }
                            },
                            legendCallback: function(chart) {
                                var text = [];
                                text.push('<ul class="legend">');
                                for (var i=0; i<chart.data.datasets[0].data.length; i++) {
                                    //console.log(chart.data.datasets[i]); // see what's inside the obj.
                                    text.push('<li>');

                                    text.push('<span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '">'  + '</span>' + chart.data.labels[i]);
                                    text.push('</li>');
                                }
                                text.push('</ul>');
                                return text.join("");
                            },
                            legend: {
                                display: false
                            },




                            title: {
                                display: true,
                                text: 'Fixed/Floating',
                                position: 'top'
                            },
                            responsive:true,
                            maintainAspectRatio: false,
                            tooltips: {
                                borderColor: 'rgba(42,51,61,1)',
                                backgroundColor: 'rgba(255,255,255,0.8)',
                                bodyFontColor: 'rgba(42,51,61,1)',
                                titleFontColor: 'rgba(42,51,61,1)',
                                mode: 'label',
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var allData = data.datasets[tooltipItem.datasetIndex].data;
                                        var tooltipLabel = data.labels[tooltipItem.index];
                                        var tooltipData = allData[tooltipItem.index];
                                        var total = 0;
                                        for (var i in allData) {
                                            total += allData[i];
                                        }

                                        var tooltipPercentage = Math.round((tooltipData / total) * 100);
                                        return tooltipLabel + ': ' + Number(tooltipData).toFixed(0).replace(/./g, function (c, i, a) {
                                            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                                        }) + ' (' + tooltipPercentage + '%)';
                                    }
                                },



                            }
                        },





                    });
            }
            document.getElementById("chart-legends2").innerHTML =  this.myChart.generateLegend();
            console.log( this.myChart.generateLegend);

        });
        },
        fetchData() {

            return this.$http.get(this.url, {params: {}});
        },
    }


}





