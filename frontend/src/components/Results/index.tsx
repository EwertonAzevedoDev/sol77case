import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthProvider/useAuth';
import './Results.css';

export const Results = () => {
    const auth = useAuth()

    const { economia, potencial, parcelamento } = auth.budget.budget;
    console.log(parcelamento)
    const listaParcelamento=parcelamento.map(
        (item, index)=>
            <li key={index}>{item.parcelas}x de  {item.valor_minimo.toFixed(2)}R$</li>
    )
    return (
        <div className="Results">
            <div className="containerResults">
                <div className='titleResult'>
                    <h1>Resultado</h1>
                </div>
                
                <div className="boxResult">
                    <p> Economia: {economia} - Potencial Solar: {potencial}</p>  
                    Opções de Parcelamento                  
                    <ul>{listaParcelamento}</ul>               
                </div>
            </div>
        </div>
      );
}

