import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthProvider/useAuth';
import './Budget.css';
export const Budget = () => {

  const [formValues, setFormValues] = useState({cep:'', valor_conta:'', tipo_telhado:''});

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
    
    async function onFinish(values: {cep: string, valor_conta: string, tipo_telhado: string}){        
        try {
           await auth.getBudget(values.cep, parseFloat(values.valor_conta), values.tipo_telhado);
           navigate('/results');
        } catch (error) {
            
        }
    }
    
  return (
    <div className="Budget">
        <div className="containerBudget">
          <div className="box"> 
            <div className='title'>
                <h1>Simulador</h1> 
            </div> 
            <form onSubmit={handleSubmit}>
              <input type="text" placeholder='CEP' name='cep' onChange={handleInputChange} value={formValues.cep}/>
              <input type="number" placeholder='Valor da conta' name='valor_conta' onChange={handleInputChange} value={formValues.valor_conta}/>
              <input type="text" placeholder='Tipo de telhado' name='tipo_telhado' onChange={handleInputChange} value={formValues.tipo_telhado}/>
              <button>Simular</button>
            </form>      
            
          </div>
        </div>
    </div>
  );
}

