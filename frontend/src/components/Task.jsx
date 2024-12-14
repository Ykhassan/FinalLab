/* eslint-disable react/prop-types */
import './Task.css'

const Task = ({TaskId, TaskName, TaskDate, TaskCompletion, handleDeletion, handleEdit}) => {
    // const [taskId, setTaskId] = useState(null);
    // const [taskName, setTaskName] = useState(null);
    // const [taskDate, setTaskDate] = useState(null);
    // const [taskCompletion, setTaskCompletion] = useState(null);


    return (
        <div className='task'>
                <h3>{TaskName}</h3>
                <div className='taskValues'>
                    <img src="      https://cdn-icons-png.flaticon.com/512/591/591623.png  " alt="schedule image" /> 
                    <span> {TaskDate} </span> |
                    <span>{TaskCompletion === 1 ? " 🟩 Completed " : "🟫 On-going "}</span>
                    <div className="button-container">
                <button className="edit-btn" onClick={() => {
                    handleEdit(TaskId);
                }}>Edit</button>
                <button className="delete-btn" onClick={() => {
                    handleDeletion(TaskId);
                }}>Delete</button>
        </div>
                </div>
        </div>
    )



};

export default Task;