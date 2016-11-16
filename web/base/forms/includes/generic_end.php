<li>
    <label></label>
    <input 
        type="submit"
        value="Submit"
        name="Update">
</li>
<li>
    <label></label>
    <button 
        type="reset" 
        value="Reset">
        Reset
    </button>
</li>

<li>
    <label></label>
    <input 
        type="button" 
        name="cancel" 
        value="Cancel" 
        onClick="window.location = '<?php echo $config['file']['index']; ?>';" />
</li>