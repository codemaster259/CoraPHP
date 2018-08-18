<h1>Demo</h1>
<p>Boxes</p>

<div class="grid-row">
    <div class="box grid-d9 automargin">
        <div class="title">
            Forms
        </div>
        <div class="body">
            <div class="form">
                <div class="grid-row">
                    <div class="grid-dhalf column">
                        <div class="input-group">
                            <input type="text" id="text1" class="input-field" required>
                            <label for="text1">Username</label>
                        </div>
                    </div>
                    <div class="grid-dhalf column">
                        <div class="input-group">
                            <input type="password" id="pass1" class="input-field" required/>
                            <label for="pass1">Pass</label>
                        </div>
                    </div>
                </div>
                <div class="grid-row">
                    <div class="grid-dhalf column">
                        <div class="input-group">
                            <select id="select1" class="input-field">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <label for="select1">Content</label>
                        </div>
                    </div>
                    <div class="grid-dhalf column">
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
                    <div class="grid-dall column">
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
        <label for="m-1" class="link-red">Open Me!</label>
    </div>
</div>

<div class="box-green">
    <div class="title">
        Checkbox - Radio
    </div>
    <div class="body">
        <label class="switch">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-blue">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-green">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-sky">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-orange">
            <input type="checkbox" checked name="ch"/>
            <span></span>
        </label>
        <label class="switch-red">
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
        <button class="btn">Gray</button>
        <button class="btn-blue">Blue</button>
        <button class="btn-green">Green</button>
        <button class="btn-sky">Sky</button>
        <button class="btn-orange">Orange</button>
        <button class="btn-red">Red</button>
        <button class="btn-black">Black</button>
    </div>
</div>

<div class="box-orange">
    <div class="title">
        Alerts
    </div>
    <div class="body">
        <div class="alert" data-lock>
            Alerts!
        </div>
        <div class="alert-blue" data-lock>
            Alerts!
        </div>
        <div class="alert-green" data-lock>
            Alerts!
        </div>
        <div class="alert-sky" data-lock>
            Alerts!
        </div>
        <div class="alert-orange" data-lock>
            Alerts!
        </div>
        <div class="alert-red" data-lock>
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
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Sed a nisl sed neque semper consequat. Nulla efficitur ut nisi a posuere. 
            Integer eget dictum mi, nec viverra orci. 
            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
            Ut maximus lacinia libero at pharetra. <label class="link-red" for="m-2">modal m-2</label>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Sed eget lorem neque. Nunc ac urna ullamcorper, mattis lectus ac, efficitur neque. 
            Aliquam eu nulla in massa tincidunt dignissim a id justo.
            <br>
            <br>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Sed a nisl sed neque semper consequat. Nulla efficitur ut nisi a posuere. 
            Integer eget dictum mi, nec viverra orci. 
            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
            Ut maximus lacinia libero at pharetra. <label class="link-green" for="m-2">modal m-2</label>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Sed eget lorem neque. Nunc ac urna ullamcorper, mattis lectus ac, efficitur neque. 
            Aliquam eu nulla in massa tincidunt dignissim a id justo.
        </div>
        <div class="footer">
            <label class="link-blue" for="m-2">modal m-2</label>
        </div>
    </div>
    </div>
</div>

<input type="checkbox" data-modal="toggle" id="m-2">
<div class="modal" data-trigger="m-2">
    <label class="modal-overlay"></label>
    <div class="modal-content">
        <div class="box-black">
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