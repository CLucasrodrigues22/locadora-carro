<template>
    <div class="container pt-5">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-6">
                    <h2 class="fw-bold py-3 mb-4">Dashboard</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <Bar
                        id="my-chart-id"
                        :options="chartOptions"
                        :data="chartData"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Bar } from 'vue-chartjs'
    import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

    ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

    export default {
        name: 'BarChart',
        components: { Bar },
        data() {
            return {
                chartData: {
                    labels: [ 'January', 'February', 'March' ],
                    datasets: [ { data: [40, 20, 12] } ]
                },
                chartOptions: {
                    responsive: true
                },
                options: {
                    'title':'My Big Pie Chart',
                }
            }
        },
        mounted() {
            this.renderChart(data, options);
        }
    }
</script>