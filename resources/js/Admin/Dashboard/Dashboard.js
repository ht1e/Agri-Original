import axios from "axios";
import { DateTime } from "luxon";
import Swal from "sweetalert2";
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const ipYear = $('#selectYear')
const btnShowChartOfYear = $('#btnShowChartOfYear')
const btnShowChartOfWeek = $('#btnShowChartOfWeek')
const ipWeek = $('#selectWeek')
const ctx = $('#myChart');
const dayInWeek = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật']
const monthInYear = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12']

const initChart = function () {
  const currentDate = DateTime.now().toFormat('yyyy-MM-dd')
  
  axios.get(`/admin/getDataOfWeek/${currentDate}`)
  .then((response) => {
    const data = response.data.data
    window.chart = new Chart(ctx, {
      type:'bar',
      data: {
        labels: dayInWeek,
        datasets:[{
          label: 'Doanh Thu',
          data: data,
          borderWidth: 1
        }]
      },
      options:{
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    })
    ipWeek.value = `${DateTime.now().year}-W${DateTime.now().weekNumber}` 
    //console.log( DateTime.now().year, DateTime.now().weekNumber)
    })
  .catch((error) => console.log(error))
}
  
setTimeout(initChart, 1000)

//hàm xử lý thời gian thay đổi theo tuần
const handleChangeWeek = (e) => {
  const value = ipWeek.value
  const year = parseInt(value.slice(0,4))
  const weekSelected = parseInt(value.slice(6))
  const currentWeek = DateTime.now().weekNumber
  let day = 1 + (weekSelected -1) * 7
  let date =  new Date(year, 0, day)
  const dayInMonth = date.getDate()
  const monthInYear = date.getMonth() + 1
  let dateSelected

  if(monthInYear < 10) {
    if(dayInMonth< 10)
      dateSelected = `${year}-0${monthInYear}-0${dayInMonth}`
    else
      dateSelected = `${year}-0${monthInYear}-${dayInMonth}`
  }
  else {
    if(dayInMonth< 10)
      dateSelected = `${year}-${monthInYear}-0${dayInMonth}`
    else
      dateSelected = `${year}-${monthInYear}-${dayInMonth}`
  }

  if(weekSelected > currentWeek) {
    Swal.fire({
      title: "Tuần bạn đã chọn là hiện tại hoặc lớn hơn. Vui lòng kiểm tra lại!!",
      icon: "warning"
    });
  } 
  else {
    axios.get(`/admin/getDataOfWeek/${dateSelected}`)
    .then((response) => {
      const data = response.data.data
      chart.data.datasets[0].data = data
      chart.data.labels = dayInWeek
      chart.update()
    })
    .catch((error) => {console.log(error)})
  }
}
//thêm sự kiện click cho nút xem theo tuần
btnShowChartOfWeek.addEventListener('click', handleChangeWeek)


//hàm xử lý thời gian thay đổi theo năm

const handleChangeYear = () => {
   const year = ipYear.value

   axios.get(`/admin/getDataOfYear/${year}`)
   .then((response) => {
    console.log(response)
    const data = response.data.data

    console.log(data)

    chart.data.labels = monthInYear
    chart.data.datasets[0].data = data
    chart.update()
   })
   .catch((error) => {console.log(error)})

}

btnShowChartOfYear.addEventListener('click', handleChangeYear)





