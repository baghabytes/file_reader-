import React,{useState,useEffect} from "react";
import http from "../http";

const Create = ()=>{
    const [formdata,setFormData] = useState({});

    const Inputevent = (event)=>{
        const name = event.target.name
        const value = event.target.value
        setFormData(prev=>({...prev,[name]:value}))
    }

    const createEvent = ()=>{
        http.post('/customers',formdata).then((res)=>{
            window.location.reload();        })
    }

    return (
        <>
<form className="mt-5" >
    <h3>Insert Customer</h3>
  <div className="form-row mt-5">
    <div className="col">
      <input type="text" className="form-control" name="name" placeholder = "Add name" onChange={Inputevent}/>
    </div>
    <div class="col">
      <input type="text" className="form-control" name="email" placeholder = "Add email" onChange={Inputevent}/>
    </div>
    <div class="col">
      <input type="text"className="form-control"  name="phone" placeholder = "Add phone" onChange={Inputevent}/>
    </div>

    </div>

    <br/>
    <div className="form-row">

    <div class="col">
      <input type="text" className="form-control" name="cnic" placeholder = "Add cnic" onChange={Inputevent}/>
    </div>
    <div class="col">
      <textarea type="text"className="form-control"  name="address" placeholder = "Add address" onChange={Inputevent}/>
    </div>

    <div class="col">
        <br/>
    <button  type="submit" class="btn btn-primary mt-2 col-md-12" onClick={createEvent}>Done</button>

   
</div>

    </div>


</form>
<br/>
<br/>
            
        </>
    )

}

export default Create;
