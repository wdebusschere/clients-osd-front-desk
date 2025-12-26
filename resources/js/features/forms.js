/**
 * Checkboxes groups toggling.
 *
 * @param groupSelector
 * @param groupToggleSelector
 * @param checkboxSelector
 */
window.setSelectAllToggles = (groupSelector = '.checkboxes-group', groupToggleSelector = '.group-toggle', checkboxSelector = '.group-checkbox') => {
    let groups = document.querySelectorAll(groupSelector);

    groups.forEach(group => {
        let toggle = group.querySelector(groupToggleSelector);
        let checkboxes = group.querySelectorAll(checkboxSelector);

        let setToggleCheckedStatus = () => {
            let checkedCheckboxes = group.querySelectorAll(`${ checkboxSelector }:checked`);

            toggle.checked = checkboxes.length === checkedCheckboxes.length;
        };

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', setToggleCheckedStatus);
        });

        setToggleCheckedStatus();

        toggle.addEventListener('change', event => {
            checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
        });
    });
};
