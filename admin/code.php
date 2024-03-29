<?php
session_start();
require_once "../connect/db_connect.php";

// Admin login
if(isset($_POST['admin_login'])){

  $email_admin = mysqli_real_escape_string($conn, $_POST['admin_email']);
  $pass_admin = mysqli_real_escape_string($conn, $_POST['admin_password']);
  
  $query = "SELECT * FROM salon_admin WHERE email = '$email_admin' AND password = '$pass_admin' ";

  $result_query = mysqli_query($conn, $query);

  if(mysqli_num_rows($result_query) == 1){
    $_SESSION['message'] = $_POST['admin_email'];
    header("Location: dashboard.php");
  } else{
    $_SESSION['message'] = "Please re-enter your gmail and password.";
    header("Location: index.php");
    exit(0);
  }

  // if($query_run){
  //   $_SESSION['message'] = "Hello!";
  //   header("Location: dashboard.php");
  //   exit(0);
  // } else{
  //     $_SESSION['message'] = "Please re-enter your gmail and password.";
  //     header("Location: dashboard.php");
  //     exit(0);
  // }
}
// Admin login

// ------------------------------------------------------------ //

// Admin logout
if(isset($_POST['logout_admin'])){
  session_destroy();
  header("Location: index.php");
}
// Admin logout

// ------------------------------------------------------------ //

// Add new service

if(isset($_POST['add_service'])){

  $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
  $service_price = mysqli_real_escape_string($conn, $_POST['service_price']);
  $availability = mysqli_real_escape_string($conn, $_POST['availability']);

  // Perform an insert mysql code
  $add_query = "INSERT INTO salon_services(service_name, availability, price) VALUES('$service_name', '$availability', '$service_price')";

  // Run the query insert
  $query_insert = mysqli_query($conn, $add_query);

  if($query_insert){
    $_SESSION['message'] = "Successfully added new service.";
    header("Location: services.php");
    exit(0);
  } else{
      $_SESSION['message'] = "Adding new service failed.";
      header("Location: services.php");
      exit(0);
  }

}
// Add new service

// ------------------------------------------------------------ //

// Update the service
if(isset($_POST['update_service'])){

  $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
  $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
  $service_price = mysqli_real_escape_string($conn, $_POST['service_price']);
  $availability = mysqli_real_escape_string($conn, $_POST['availability']);

  $query_update = "UPDATE salon_services 
                  SET service_name = '$service_name', availability = '$availability', price = '$service_price' 
                  WHERE services_id = '$service_id' ";

  $query_run_update = mysqli_query($conn, $query_update);

  if($query_run_update){
    $_SESSION['message'] = "Service updated successfully!";
    header("Location: services.php");
    exit(0);
  } else{
      $_SESSION['message'] = "Updating service failed.";
      header("Location: services.php");
      exit(0);
  }
}
// Update the service

// ------------------------------------------------------------ //

// Delete the service
if(isset($_POST['delete_service'])){

  $service_id = mysqli_real_escape_string($conn, $_POST['delete_service']);

  $query_delete = "DELETE FROM salon_services WHERE services_id = '$service_id' ";

  $query_del = mysqli_query($conn, $query_delete);

  // If deleted successfully perform this 
  if($query_run){
    $_SESSION['message'] = "Service deleted successfully!";
    header("Location: services.php");
    exit(0);
    
    // otherwise, print the failed delete
  } else{
      $_SESSION['message'] = "Deleting the service failed.";
      header("Location: services.php");
      exit(0);
  }
}
// Delete the service

// --------------------------------------------------------------- //

// Update customer account
if(isset($_POST['update_customer'])){

  $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);

  $c_fullname = mysqli_real_escape_string($conn, $_POST['c_fullname']);
  $c_phone = mysqli_real_escape_string($conn, $_POST['c_phone']);
  $c_email = mysqli_real_escape_string($conn, $_POST['c_email']);

  $update_query = "UPDATE salon_customer SET fullname = '$c_fullname', phone = '$c_phone', email = '$c_email' WHERE customer_id = '$customer_id' ";

  $update_run = mysqli_query($conn, $update_query);

  if($update_run){
    $_SESSION['message'] = "Customer account update successfully!";
    header("Location: customers.php");
    exit(0);
  } else{
    $_SESSION['message'] = "Updating customer account failed.";
    header("Location: update_customer.php");
    exit(0);
  }
}
// Update customer account

// Delete the customer account
if(isset($_POST['delete_customer'])){

  $customer_id = mysqli_real_escape_string($conn, $_POST['delete_customer']);

  $customer_del = "DELETE FROM salon_customer WHERE customer_id = '$customer_id' ";

  $delete_run = mysqli_query($conn, $customer_del);

  // If deleted successfully perform this 
  if($delete_run){
    $_SESSION['message'] = "Customer account deleted.";
    header("Location: customers.php");
    exit(0);
    
    // otherwise, print the failed delete
  } else{
    $_SESSION['message'] = "Deleting the customer failed.";
    header("Location: customers.php");
    exit(0);
  }

}
// Delete the customer account

// --------------------------------------------------------------- //

// Update appointment
// Update appointment

// Delete appointment

if(isset($_POST['delete_appointment'])){

  $appointment_id = mysqli_real_escape_string($conn, $_POST['delete_appointment']);

  $appointment_query = "DELETE FROM salon_appointments WHERE appointments_id = '$appointment_id' ";

  $appointment_run = mysqli_query($conn, $appointment_query);

  // If deleted successfully perform this 
  if($appointment_run){
    $_SESSION['message'] = "Appointment deleted.";
    header("Location: appointments.php");
    exit(0);
    
    // otherwise, print the failed delete
  } else{
    $_SESSION['message'] = "Deleting appointment failed.";
    header("Location: appointments.php");
    exit(0);
  }

}

// Delete appointment




?>