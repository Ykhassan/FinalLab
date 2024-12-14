import { useEffect, useState } from 'react';
import './MiddleBar.css'
import Task from './Task';
import RightBar from './RightBar'

const MiddleBar = () => {

    const [userTasks, setUserTasks] = useState([]);
    function del(id){
        // logic to delete first find ID, then send request, then delete  the task from the middle component
        console.log('deleting', userTasks.find(task => task.id === id));
    }

    function edit(id, taskName, dateValue){
        // logic to eddit first find ID, then send request, then update the task in the middle component
        let Task =  userTasks.find(task => task.id === id);
        taskName.target.value = Task.task;
        dateValue.target.value = Task.date_added;
    }
    // Note useEffect will be executed each time a rerender occur

    useEffect(
         () => {
            async function m() {
            let response = await fetch("http://localhost:8080/api/displayTasks.php");
            let data = await response.json();
            await setUserTasks(data.task)
            }
            m();
        }
    , []);

    return (
        <>
        <div className='middleBar'>
                <h1> Task </h1>
               { 
               userTasks 
               ? 
               userTasks.map(task => (
                <Task 
                key={task.id}
                TaskId={task.id}
                TaskName={task.task}
                TaskDate={task.date_added}
                handleDeletion={del}
                handleEdit={edit} />
              ))
              :
              <div className='none'>
                No Tasks To Display
                Add New Tasks
              </div>
              }
        </div>
        <RightBar/>
        </>
    )

};

export default MiddleBar