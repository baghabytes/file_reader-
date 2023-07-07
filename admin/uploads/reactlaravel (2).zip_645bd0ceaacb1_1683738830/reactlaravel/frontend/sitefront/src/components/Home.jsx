import React,{useState,useEffect} from "react";
import http from "../http";

const Home = ()=>{
    const [customers,setCustomers] = useState([]);
    
    useEffect(()=>{
        fetchAllUsers();
    },[]);

    const fetchAllUsers = ()=>{
        http.get('/customers').then(res=>{
            setCustomers(res.data);
        })      
    }

    return (
        <>

<h5>Customer Record</h5>
            <table className="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">CNIC</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                </tbody>
                {      
            customers.map((customer,ind)=>{
                return (
                    <tr key={customer.id}>

                        <td>{++customer.id}</td>
                        <td>{customer.name}</td>
                        <td>{customer.email}</td>
                        <td>{customer.cnic}</td>
                        <td>{customer.phone}</td>
                        <td>{customer.address}</td>
                        <td>
                        <button type="submit" class="btn btn-danger mb-2">Delete</button>
                        &nbsp; &nbsp; <button type="submit" class="btn btn-success mb-2">Edit</button>


                        </td>

                    </tr>
                )
            })
            
        }
               
                
                </table>


       
        </>
    )

}

export default Home;
