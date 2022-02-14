import { useState } from 'react';
import { useAuth } from '../../context/AuthProvider/useAuth';
import { useNavigate } from 'react-router-dom';
import logo from './logo.png';
import './Login.css';

export const Login = () => {
    const [formValues, setFormValues] = useState({email:'', password:''});

    const handleInputChange = (e: any) => {       
        const {name, value} = e.target;         
        setFormValues({...formValues, [name]: value})      
    }

    const handleSubmit = (e: any) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);
        onFinish(formValues)
    }
    
    const auth = useAuth()
    const navigate = useNavigate()
    
    async function onFinish(values: {email: string, password: string}){        
        try {
           await auth.authenticate(values.email, values.password);
           navigate('/budget');
        } catch (error) {
            
        }
    }

    return (
        <div className="Login">
            <div className="containerLogin">
              <div className="box">
                <img src={logo}/>
                <form onSubmit={handleSubmit}>
                    <input type="text" name='email' placeholder='E-mail' onChange={handleInputChange} value={formValues.email}/>
                    <input type="password" name='password' placeholder='Senha' onChange={handleInputChange} value={formValues.password}/>
                    <button>Login</button>
                </form>
                
              </div>
            </div>
        </div>
      );
}