import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AltaEventoComponent } from './alta-evento.component';

describe('AltaEventoComponent', () => {
  let component: AltaEventoComponent;
  let fixture: ComponentFixture<AltaEventoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AltaEventoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AltaEventoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
