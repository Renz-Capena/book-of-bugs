const date = new Date

const months = ['January','February','March','April','May','June','July','Agust','September','October','November','December']

const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

// console.log(date)
console.log(months[date.getMonth()])
console.log(date.getDate())
console.log(date.getFullYear())
console.log(days[date.getDay()])
console.log("==========================")
console.log(date.getHours())
console.log(date.getMinutes())

