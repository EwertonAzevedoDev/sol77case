export interface IUser {
    email?: string;
    token?: string;
    budget?: object;
}

export interface IContext extends IUser {
    authenticate: (email: string, password: string) => Promise<void>;
    getBudget:(cep: string, valor_conta: number, tipo_telhado: string) => Promise<void>;
    logout: () => void;
}

export interface IAuthProvider {
    children: JSX.Element;
}