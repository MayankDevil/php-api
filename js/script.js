/*
-   PHP API
-   developer : https://mayankdevil.github.io/MayankDevil
-   JavaScript : /js/script.js
-   ajax fetch php api
*/

$(document).ready(function () {

    /* messageBox function alert message display */

    function messageBox(status, text)
    {
        if (status)
        {
            $("#alertBox").addClass('alert alert-success').text(text).fadeIn()
        }
        else
        {
            $("#alertBox").addClass('alert alert-danger').text(text).fadeIn()
        }
        setTimeout(() => {
        
            $("#alertBox").fadeOut("slow")
        
        }, 4000)
    }
    
    /* loadData function fetch load all data php file */

    function loadData() 
    {
        $.ajax({
            url : 'api/all-data.php',
            type : 'GET',
            beforeSend : () => {
                
                $("#output_result").html(`
                    <div class="spinner-border" role="status" id='loader'>
                        <span class="visually-hidden">Loading...</span>
                    </div>
                `)
            },
            success : (response) => {

                $("#output_result").append(`
                    <div class='row bg-light'>
                        <div class='col-2'> Id </div>
                        <div class='col'> Name </div>
                        <div class='col-2'> Gender </div>
                        <div class='col-2 text-end'> Option </div>
                    </div>
                `)

                let return_data = JSON.parse(response)

                // console.log(return_data.message)

                if (return_data.status) 
                {
                    let data = return_data.data

                    for (let i = 0; i < data.length; i++)
                    {
                        let id = data[i]['id']
                        $("#output_result").append(`
                            <div class='row d-flex align-items-center border'>
                                <div class='col-2 p-1'> ${id} </div>
                                <div class='col p-1'> ${data[i]['fname']} ${data[i]['lname']} </div>
                                <div class='col-2 p-1'> ${(data[i]['gender'] == 'F')? "Female":(data[i]['gender'] == 'M')? "Male" : "Transgender"} </div>
                                <div class='col-2 d-flex justify-content-between'>
                                    <button class='btn btn-success btn-sm py-1 editButton' value='${id}'> edit </button>
                                    <button class='btn btn-danger btn-sm py-1 deleteButton' value='${id}'> delete </button>
                                </div>
                            </div>
                        `)
                    }
                }
                else
                {   
                    messageBox(0, `warning ${return_data.message}`)
                }
            },
            error : (error) => {

                messageBox(0, `ajax fetch failed : ${error}`)
            },
            complete : () => {
                
                $("#output_result #loader").hide()
            }
        })
    }

    /* delete button on click delete and load data */ 

    $(document).on("click", ".deleteButton", function () {
        
        let row_id = $(this).attr('value')

        console.log(row_id)

        $.ajax({
            url : 'api/delete-data.php',
            type : 'POST',
            data : {
                deleteId : row_id
            },
            success : (response) => {
                
                let return_data = JSON.parse(response)
    
                messageBox(return_data.status, return_data.message)
            },
            error : (error) => {
    
                messageBox(0, ` ajax not deleted : ${error} `)
            },
            complete : () => {
    
                loadData()
            }
        })
    })
    
    /* edit button function on click update form set */

    $(document).on("click", ".editButton", function () {

        $("#updateButton").show("slow")
        $("#insertButton").hide("slow")

        let row_id = $(this).attr('value')

        // console.log(row_id)

        $.ajax({
            url : 'api/single-data.php',
            type : 'POST',
            data : {
                employee_id : row_id
            },
            success : (response) => {
                
                let return_data = JSON.parse(response)

                if (return_data.status)
                {
                    $("#id").val(`${return_data.data['id']}`),
                    $("#first_name").val(`${return_data.data['fname']}`)
                    $("#last_name").val(`${return_data.data['lname']}`)
                    
                    let gender = return_data.data['gender']

                    if(gender == "F")
                    {
                        $('#gender1').prop('checked', true)
                    }
                    else if(gender == "M")
                    {
                        $('#gender2').prop('checked', true)
                    }
                    else if(gender == "T")
                    {
                        $('#gender3').prop('checked', true)
                    }
                }

                messageBox(return_data.status, return_data.message)
            },
            error : (error) => {

                messageBox(0, `ajax not get data : ${error} `)
            }
        })                
    })

    /* update button function on click update file and load data */

    $("#updateButton").on("click", function (e) {

        e.preventDefault()
        
        $.ajax({
            url : 'api/update-data.php',
            type : 'POST',
            data : {
                id : $("#id").val(),
                first_name : $("#first_name").val(),
                last_name : $("#last_name").val(),
                gender : $("input:radio[name=gender]:checked").val()
            },
            success : (response) => {
                
                let return_data = JSON.parse(response)

                messageBox(return_data.status, return_data.message)
            },
            error : (error) => {

                messageBox(0, ` ajax not deleted : ${error} `)
            },
            complete : () => {

                $("#insertForm").trigger("reset")
                $("#updateButton").hide("slow")
                $("#insertButton").show("slow")

                loadData()
            }
        })
    })

    /* insert button on click insert and load data */
    
    $("#insertButton").on("click", function (e) {

        e.preventDefault()

        console.log($("#id").val())

        $.ajax({
            url : 'api/insert-data.php',
            type : 'POST',
            data : {
                id : $("#id").val(),
                first_name : $("#first_name").val(),
                last_name : $("#last_name").val(),
                gender : $("input:radio[name=gender]:checked").val()
            },
            success : (response) => {
                
                let return_data = JSON.parse(response)

                messageBox(return_data.status, return_data.message)
            },
            error : (error) => {
                
                messageBox(0, ` ajax not inserted : ${error} `)
            },
            complete : () => {

                $("#insertForm").trigger("reset")

                loadData()                        
            }
        })
    })

    $("#updateButton").hide()

    loadData() // load at less
})