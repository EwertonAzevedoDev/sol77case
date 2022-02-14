import { useState } from 'react'
import { AuthProvider } from './context/AuthProvider'
import {BrowserRouter, Route, Routes } from 'react-router-dom'
import { ProtectedLayout } from './components/ProtectedLayout'
import { Login } from './components/Login'
import { Budget } from './components/Budget'
import { Results } from './components/Results'

function App() {
 

  return (
    <AuthProvider>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<Login />}/>
          <Route 
            path='/budget' 
            element={
            <ProtectedLayout>
              <Budget/>
            </ProtectedLayout>
            }
          />
          <Route 
            path='/results' 
            element={
            <ProtectedLayout>
              <Results/>
            </ProtectedLayout>
            }
          />
        </Routes>
      </BrowserRouter>
    </AuthProvider>
  )
}

export default App
