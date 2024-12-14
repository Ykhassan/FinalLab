/* eslint-disable react/prop-types */
/* eslint-disable no-unused-vars */
import './RightBar.css'

const RightBar = ( {TaskDescription, Taskdate, TaskName}) => {

    return (
        <div className='rightBar'>
            <div className='header'>
                <h3>Task:</h3>
                <img src='  https://cdn-icons-png.flaticon.com/512/458/458595.png  ' alt='menue-bar icon'></img>
            </div>
            <div className='break'></div>
            <div className='taskDetails'>
                <input className='inputStyle' name='taskName' placeholder='Task Name'></input>
                <textarea className='inputStyle' name='taskDescritption' placeholder='Description'></textarea>
                <div className='date'> 
                    <input name='taskDate' type='date'></input>
                    <input name='taskDate' type='date'></input>
                </div>
            </div>
        </div>
    )
};

export default RightBar;