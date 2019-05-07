<!--------------------
START - Chat Popup Box
-------------------->
  <div class="floated-chat-btn">
    <i class="os-icon os-icon-mail-07"></i><span>Help Desk</span>
  </div>
  <div class="floated-chat-w">
    <div class="floated-chat-i">
      <div class="chat-close">
        <i class="os-icon os-icon-close"></i>
      </div>
      <div class="chat-head">
        <div class="user-w with-status status-green">
          <div class="user-avatar-w">
            <div class="user-avatar">
              <img alt="" src="{{ asset('admin/img/avatar1.jpg')}}">
            </div>
          </div>
          <div class="user-name">
            <h6 class="user-title">
              {{ Auth::user()->name }}
            </h6>
            <div class="user-role">
              Administrador do Sistema
            </div>
          </div>
        </div>
      </div>
      <div class="chat-messages">
        <div class="message">
          <div class="message-content">
            Oi, eu tentei encomendar este produto e ele continua me mostrando o código de erro.                        
          </div>
        </div>
        <div class="date-break">
          Seg 10:20am
        </div>
        <div class="message self">
          <div class="message-content">
           Olá, meu nome é Mike, terei prazer em ajudá-lo
          </div>
        </div>
        <div class="message self">
          <div class="message-content">
            Por gentileza pode nos enviar o cod e mais detalhes do erro retornado?
          </div>
        </div>
      </div>

      <div class="chat-controls">

        <input class="message-input" placeholder="Digite sua mensagem aqui ..." type="text">
        
        <div class="chat-extra">
          <a href="#">
            <span class="extra-tooltip">Enviar Imagens</span><i class="os-icon os-icon-documents-07"></i>
          </a>
          <a href="#">
            <span class="extra-tooltip">Upload de Video</span><i class="os-icon os-icon-others-29"></i>
          </a>
          <a href="#">
            <span class="extra-tooltip">Anexar Documento</span><i class="os-icon os-icon-ui-51"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
<!--------------------
END - Chat Popup Box
-------------------->