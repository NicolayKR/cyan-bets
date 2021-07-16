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
        currentData: this.chartData,
        option: { 
            legend: {
                display: false,
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
            tooltips :{
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
    mounted () {
        this.updateGraphData();
    },
    methods:{
        updateGraphData(){
            if(this.windowWidth < 524){
                this.option.scales.xAxes[0].ticks.fontSize =  10;
                this.option.tooltips = false;
            };
            this.renderChart(this.currentData, this.option);
        }
    }
}
</script>