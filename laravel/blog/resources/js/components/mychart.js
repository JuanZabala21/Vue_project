import { Doughnut } from 'vue-chartjs'
 
export default {
  extends: Doughnut,
  mounted () {
      var inm
    axios
    .get("/getallinm")
    .then(data => {
        inm=data.data
        let total=0,charData=[["Bejuma",0],["Carlos Arvelo",0],["Diego Ibarra",0],["Guacara",0],["Juan José Mora",0],
        ["Libertador",0],["Los Guayos",0],["Miranda",0],["Montalbán",0],["Naguanagua",0],["Puerto Cabello",0],
        ["San Diego",0],["San Joaquín",0],["Valencia",0]]
        inm.forEach(inmueble => {
            charData.forEach(element => {
                if(element[0]==inmueble.ubicacion){
                    element[1]+=1
                    total+=1
                }
            });
        });
        charData.forEach(a => a.splice(0, 1));
    this.renderChart({
      labels: ["Bejuma","Carlos Arvelo","Diego Ibarra","Guacara","Juan José Mora","Libertador","Los Guayos","Miranda",
      "Montalbán","Naguanagua","Puerto Cabello","San Diego","San Joaquín","Valencia"],
      datasets: [
        {
          label: 'Inmuebles\nTotal: '+total,
          backgroundColor: ['green','blue','red','yellow',"white","cyan","blueviolet","chocolate","darkgray",
          "crimson","azure","chartreuse","aquamarine","orange"],
          data: charData
        }
      ],
      options: {
        
    }
    })
    this._data._chart.config.options.title.text='Total: '+total,
    this._data._chart.config.options.title.display=true
    this._data._chart.config.options.title.fontSize=20
    this._data._chart.config.options.title.padding=280
    this._data._chart.config.options.title.position="top"

    })
    
  }
}