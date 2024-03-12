import React from 'react';
import ReactDOM from 'react-dom/client';

export default function Home(){
    return (
        <div>
            <h1>hello world</h1>
            <form action="">
                <input type="text" />
                <button type='submit'>submit</button>
            </form>
        </div>
        
    );
}

const container = document.getElementById('app');
const root = ReactDOM.createRoot(container);
root.render(<Home/>)
