/* *****************************************************************************************
 *  
 *  Event EventBus
 *  
 *  
 */
const EventBus = new Vue();

/* *****************************************************************************************
 *  
 *  Main Components 
 *  
 *  
 */

/**
 * WeeklyCohortTable
 */
const WeeklyCohortTable = Vue.component('weekly-cohort-table',{
	components: {
		
	},
	props: {
		dataSet: {
			type: Array,
			required: true
		},
		labels: {
			type: Array,
			required: true
		},
		onboardingSteps: {
			type: Array,
			required: true
		},
	},
	data(){
		return {
			steps: []
		}
	},
	created() {
		
	},
	mounted() {
		
	},
	watch: {
		
	},
	methods: {
		
	},
	template:`  	
  		<div class="wrapper table">
  			
		  	<table>
			    <thead>
			        <tr>
			            <th scope="col">
			            	<span>Cohort</span>
			            </th>
			            <th scope="col" v-for="step in onboardingSteps.keys()" v-if="onboardingSteps[step] === 0">
			            	<span>{{ step }}%</span>
			            </th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr v-for="(row, index) in dataSet">
			            <th scope="row">
			            	<span>{{ labels[index] }}</span>
			            </th>
			            <td v-for="cell in row">
			            	<span>{{ cell }}%</span>
			            </td>
			        </tr>
			    </tbody>
			</table>
  		</div>`
});

/**
 * WeeklyCohortChart
 */
const WeeklyCohortChart = Vue.component('weekly-cohort-chart',{
	components: {
		'weekly-cohort-table': WeeklyCohortTable
	},
	props: {
		
	},
	data(){
		return {
			dataset: [],
			datasetWeeklyAggregate: [],		
			labelsStartDateWeek: [],
			onboardingSteps: [],
		}
	},
	created() {
		
		this.init();
		
		this.onboardingSteps = this.getOnBoardingSteps();
	},
	mounted() {
		
	},
	watch: {
		dataset: function (val) {

			this.convertDataSetForWeeklyWeeklyCohortChart();

			this.displayDataSet();
		}
	},
	methods: {

		/**
    	 * @name init
    	 * @description 
    	 */
		init() { 
			
			this.getDataSet();
		},

		/**
    	 * @name getData
    	 * @description 
    	 */
		getDataSet() {
			let where = '/private-api/get-retention-curve-weekly-cohorts';

			axios.get(where, new URLSearchParams()).then((response) => {

				this.dataset = response.data.weeks;
			});
		},

		/**
    	 * @name convertDataForCharts
    	 * @description 
    	 */
		convertDataSetForWeeklyWeeklyCohortChart() { 
			
			for (const week of this.dataset) {
				
				let dateIndex = new Date(week.days[0].createdAt.date).toDateString();
				
				let dataWeek = [];
			
				this.labelsStartDateWeek.push(`${dateIndex}`);
				
				let onboardingPerWeek = this.getOnBoardingSteps();

				for (const day of week.days) {
					
					for(const onboarding of day.onboardings) {
						
						/* @note There are also other percentages in the dataset, but I consider only the knew Onboarding steps. */
						if(typeof onboardingPerWeek[onboarding.percentage.toString()] !== 'undefined') {
							
							onboardingPerWeek[onboarding.percentage.toString()] = onboardingPerWeek[onboarding.percentage.toString()] + 1;
						}
					}
				}
				
				/**
				 * @todo Need a double check
				 * 
				 * */
				let tot_per_week = 0;
				onboardingPerWeek.map(onboarding => tot_per_week = tot_per_week + onboarding );
				
				onboardingPerWeek = onboardingPerWeek.map(onboarding => 100 - parseInt((onboarding * 100) / tot_per_week));

				onboardingPerWeek.map(onboarding => dataWeek.push(onboarding));
				
				this.datasetWeeklyAggregate.push(dataWeek);
			}
		},

		/**
    	 * @name drawChart
    	 * @description 
    	 */
		drawChart() {
			
			let parsedDatasetWeeklyAggregate = JSON.parse(JSON.stringify(this.datasetWeeklyAggregate))
			console.log("parsedDatasetWeeklyAggregate", parsedDatasetWeeklyAggregate);
			
			/* Lets use 'this' (vue obj) inside map function */
			let self = this;
			
			new Chart(document.getElementById("line-chart"), {
				  type: 'line',
				  data: {
					  	/* @todo use getOnBoardingSteps() instead */
					    labels: ['0%', '20%', '40%', '50%', '70%', '90%', '99%', '100%'],
					    
					    datasets: parsedDatasetWeeklyAggregate.map(function(week, index) {
					    	return {
					    		data: week,
						        label: self.labelsStartDateWeek[index],
							    borderColor: self.getRandomColor(),
							    fill: true
					    	}
					    })
				  },
				  options: {
				    title: {
				      display: true,
				      text: 'Weekly cohort'
				    },
				    scales: {
				    	xAxes: [{
				    		scaleLabel: {
				              display: true,
				              labelString: 'Onboarding percentage'
				            }
				    	}],
				        yAxes: [{
				          ticks: {
				            beginAtZero: true,
				            min: 0,
				            max: 100,
				            stepSize: 25,
				          },
				          scaleLabel: {
				              display: true,
				              labelString: 'Users percentage'
				          }
				        }]
				      },
				      tooltips: {
		                  enabled: true,
		                  mode: 'single',
		                  callbacks: {
	                           label: function (tooltipItems, data) {
	                        	   return `${tooltipItems.datasetIndex} weeks later ${tooltipItems.yLabel}% of users have been or are still in this step`;
	                           }
		                  }
				      }
				  }
				});
		},
		
		/**
    	 * @name getOnBoardingSteps
    	 * @description 
    	 */
		getOnBoardingSteps() {
			
			let onboardingPerWeek = [];
			
			onboardingPerWeek['0'] = 0;
			onboardingPerWeek['20'] = 0;
			onboardingPerWeek['40'] = 0;
			onboardingPerWeek['50'] = 0;
			onboardingPerWeek['70'] = 0;
			onboardingPerWeek['90'] = 0;
			onboardingPerWeek['99'] = 0;
			onboardingPerWeek['100'] = 0;
			
			return onboardingPerWeek;
		},
		
		/**
    	 * @name getRandomColor
    	 * @description 
    	 */
		getRandomColor() {
			
			var color = '#';
			for (var i = 0; i < 6; i++) {
				color += '0123456789ABCDEF'[Math.floor(Math.random() * 16)];
			}
			
			return color;
		},
		
		/**
    	 * @name displayDataSet
    	 * @description 
    	 */
		displayDataSet() {

			this.drawChart();
		}
	},
  	template:`  	
  		<div class="wrapper chart-and-table">
  			<div class="wrapper chart">
  				<canvas id="line-chart" width="800" height="450"></canvas>
  			</div>
  			<weekly-cohort-table :dataSet="datasetWeeklyAggregate" :labels="labelsStartDateWeek" :onboardingSteps="onboardingSteps"></weekly-cohort-table>
  		</div>`
});

/* *****************************************************************************************
 *  
 *  Main Vue Object
 *  
 */
const vm = new Vue({
    el: '#app',
    components: {
        'weekly-cohort-chart': WeeklyCohortChart
    },
    data: {
    	
    },
    created(){
		
	},
    methods: {

	}
});