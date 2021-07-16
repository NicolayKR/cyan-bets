<script>
import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  props: {
        chartData:{
            default:()=>{}
        }, 
        windowWidth:{
            default: null
        },
  },
  data(){
      return {
        option: { 
            legend: {
                display: true,
            },
            scales: {
                xAxes: [{
                    display: true,
                    ticks: { 
                        fontFamily: "'Roboto', sans-serif", 
                        fontColor: '#000'
                    }
                }],
                yAxes: [{
                    ticks: {                        
                        fontFamily: "'Roboto', sans-serif", 
                        fontColor: '#000'                           
                    }
                }]
            },
            tooltips: {
                display: true,
                bodyFontSize: 12
            },
            responseive : true ,
            maintainAspectRatio : false ,
            bezierCurve : false,
            animation : { 
                duration : 500
            } , 
            hover : { 
                animationDuration : 500 
                }, 
            responseiveAnimationDuration : 500 
            }
        }
    },
    watch:{
        chartData(){
           this.renderChart(this.chartData, this.option);
        }
    },
    mounted () {
        this.renderChart(this.chartData, this.option);
        
    },
    methods:{
        
    }
}
</script>