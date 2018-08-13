<h1>Demo</h1>
<p>Boxes</p>

<div class="row">
    <div class="box round">
        <div class="title">
            Forms
        </div>
        <div class="body">
            <div class="form">
                <div class="grid-row">
                    <div class="grid-half column">
                        <div class="input-group">
                            <input type="text" id="text1" class="input-field" required>
                            <label for="text1">Username</label>
                        </div>
                    </div>
                    <div class="grid-half column">
                        <div class="input-group">
                            <input type="password" id="pass1" class="input-field" required/>
                            <label for="pass1">Pass</label>
                        </div>
                    </div>
                </div>
                <div class="grid-row">
                    <div class="grid-half column">
                        <div class="input-group">
                            <select id="select1" class="input-field">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <label for="select1">Content</label>
                        </div>
                    </div>
                    <div class="grid-half column">
                        <div class="input-group">
                            <label class="input-label">Are you sure?
                                <label class="switch-red">
                                    <input type="checkbox" checked name="ch"/>
                                    <span></span>
                                </label>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="grid-row">
                    <div class="grid-all column">
                        <div class="input-group">
                            <textarea type="password" id="area1" class="input-field"/></textarea>
                            <label for="area1">Content</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box-blue">
    <div class="title">
        Modal Checkbox
    </div>
    <div class="body">
        <label for="m-1" class="btn-green">Open Me!</label>
    </div>
</div>

<div class="box-green round">
    <div class="title">
        Checkbox - Radio
    </div>
    <div class="body">
        <label class="switch">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-blue round">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-green">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-sky round">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-orange">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-red round">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-black">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
    </div>
</div>

<div class="box-sky">
    <div class="title">
        Buttons
    </div>
    <div class="body">
        <button class="btn round">Gray</button>
        <button class="btn-blue">Blue</button>
        <button class="btn-green round">Green</button>
        <button class="btn-sky">Sky</button>
        <button class="btn-orange round">Orange</button>
        <button class="btn-red">Red</button>
        <button class="btn-black round">Black</button>
    </div>
</div>

<div class="box-orange round">
    <div class="title">
        Alerts
    </div>
    <div class="body">
        <div class="alert" data-lock>
            Alerts!
        </div>
        <div class="alert-blue round" data-lock>
            Alerts!
        </div>
        <div class="alert-green" data-lock>
            Alerts!
        </div>
        <div class="alert-sky round" data-lock>
            Alerts!
        </div>
        <div class="alert-orange" data-lock>
            Alerts!
        </div>
        <div class="alert-red round" data-lock>
            Alerts!
        </div>
        <div class="alert-black" data-lock>
            Alerts!
        </div>
    </div>
</div>

<input type="checkbox" data-modal="toggle" id="m-1">
<div class="modal" data-trigger="m-1">
    <label class="modal-overlay" for="m-1"></label>
    <div class="modal-content">
        <div class="box-red">
        <div class="title">
            News
            <label data-modal="close" for="m-1">&times;</label>
        </div>
        <div class="body">
            More Content!!! <label class="btn-black" for="m-2">modal m-2</label>
        </div>
    </div>
    </div>
</div>

<input type="checkbox" data-modal="toggle" id="m-2">
<div class="modal" data-trigger="m-2">
    <label class="modal-overlay"></label>
    <div class="modal-content">
        <div class="box-black round">
            <div class="title">
                News
                <label data-modal="close" for="m-2">&times;</label>
            </div>
            <div class="body">
                More Content!!!
            </div>
        </div>
    </div>
</div>