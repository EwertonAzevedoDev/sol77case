import React, {createContext, useEffect, useState} from "react";
import { IAuthProvider, IContext, IUser } from "./types";
import { BudgetRequest, getUserLocalStorage, LoginRequest, setUserLocalStorage } from "./util";

export const AuthContext = createContext<IContext>({} as IContext)

export const AuthProvider = ({ children}: IAuthProvider) => {
    const [user, setUser] = useState<IUser | null>();

    useEffect(() => {
        const user = getUserLocalStorage()

        if(user){
            setUser(user);
        }
    }, [])

    async function authenticate(email: string, password: string) {
        const response = await LoginRequest(email, password);

        const payload = {token: response.token, email};

        setUser(payload);
        setUserLocalStorage(payload);
    }

    async function getBudget(cep: string, valor_conta: number, tipo_telhado: string) {
        const response = await BudgetRequest(cep, valor_conta, tipo_telhado);

        const budget = {budget: {potencial: response.budget.potencial, 
                                economia: response.budget.economia,
                                parcelamento: response.budget.parcelamento}};
        console.log(budget);
        setUser({...user, budget})
        setUserLocalStorage({...user, budget})
    }

    function logout() {
        setUser(null);
        setUserLocalStorage(null);
    }

    return (
        <AuthContext.Provider value={{...user, authenticate, logout, getBudget }}>
            {children}
        </AuthContext.Provider>
    )
}